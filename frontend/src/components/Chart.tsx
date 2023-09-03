import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend,
} from 'chart.js';
import { Bar } from 'react-chartjs-2';
import { faker } from '@faker-js/faker';
import { useEffect, useState } from 'react';
import axios, { AxiosResponse } from 'axios';
import { useDispatch, useSelector } from 'react-redux';
import { chartActions } from '../store/chart-slice';

ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend
);

export const options = {
  responsive: true,
  scales: {
    y: {
      beginAtZero: true,
      ticks: {
        // Define uma função de formatação personalizada para o eixo Y
        callback: (value: any) => `R$ ${value.toFixed(2).replace('.', ',')}`, // Formata como "R$ XX,X"
      },
    },
  },
  plugins: {
    legend: {
      position: 'top' as const,
    },
    title: {
      display: true,
      text: 'PRODUCTS SELLS CHART',
    },
    
  },
};

// MOCKUPS TEMPORARIOS ENQUANTO NÃO FOI PERSISTIDO O DADO DO BANCO
const labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
export const data = {
  labels,
  datasets: [
    {
      label: 'Vendas realizadas',
      data: labels.map(() => faker.datatype.number({ min: 0, max: 1000 })),
      backgroundColor: 'green',
    },
    {
        label: 'Venda prevista',
        data: labels.map(() => faker.datatype.number({ min: 0, max: 1000 })),
        backgroundColor: 'blue',
    },
    {
        label: 'Quantidade de produtos vendidos',
        data: labels.map(() => faker.datatype.number({ min: 0, max: 1000 })),
        backgroundColor: 'red',
    },
  ],
};

export default function Chart() {
  const [chartData, setChartData] = useState(data);
  const selector = useSelector((store: any) => store.chart);
  const dispatch = useDispatch();
  useEffect(() => {
    if(selector.selectedData === '') {
      axios.get('http://localhost/api/sells/all')
      .then(( response : AxiosResponse ) => {
        // Processar os dados da resposta da API
        const apiData: 
          { periods: string[]; 
            total_price_sells: number[]; 
            sell_forecasts: number[], 
            product_counts: number[] 
          } = response.data;

          console.log(apiData)
        
        // Atualizar os dados do gráfico com os dados da API
        const updatedData = {
          labels: apiData.periods,
          datasets: [
            {
              label: 'Vendas realizadas',
              data: apiData.total_price_sells,
              backgroundColor: 'green',
            },
            {
              label: 'Venda prevista',
              data: apiData.sell_forecasts,
              backgroundColor: 'blue',
            },
            {
              label: 'Quantidade de produtos vendidos',
              data: apiData.product_counts,
              backgroundColor: 'red',
            },
          ],
        };

        setChartData(updatedData);
        dispatch(chartActions.putAllData(updatedData));
      })
      .catch((error) => {
        console.error('Erro ao buscar dados da API:', error);
      });
    }
    else {
      if(selector.selectedData === 'all') {
        setChartData(selector.data.all)
      } else {
        if(selector.data.byYear[selector.selectedData] !== undefined) {
          setChartData(selector.data.byYear[selector.selectedData])
        }
      }
    }
  }, [selector.data.byYear, selector.selectedData]);
  return (<Bar options={options} data={chartData} />);
}
