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
  plugins: {
    legend: {
      position: 'top' as const,
    },
    title: {
      display: true,
      text: 'Chart.js Bar Chart',
    },
  },
};

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
  useEffect(() => {
    axios.get('http://localhost/api/sells/all')
      .then(( response : AxiosResponse ) => {
        // Processar os dados da resposta da API
        const apiData: { periods: string[]; total_price_sells: number[]; sell_forecasts: number[], product_counts: number[] } = response.data;
        // Atualizar os dados do gráfico com os dados da API
        const updatedData = {
          labels: apiData.periods,
          datasets: [
            {
              label: 'Vendas realizadas',
              data: apiData.total_price_sells, // Substitua com os dados corretos da API
              backgroundColor: 'green',
            },
            {
              label: 'Venda prevista',
              data: apiData.sell_forecasts, // Substitua com os dados corretos da API
              backgroundColor: 'blue',
            },
            {
              label: 'Quantidade de produtos vendidos',
              data: apiData.product_counts, // Substitua com os dados corretos da API
              backgroundColor: 'red',
            },
          ],
        };

        setChartData(updatedData);
        console.log(chartData)
      })
      .catch((error) => {
        console.error('Erro ao buscar dados da API:', error);
      });
  }, []);
  return (<Bar options={options} data={chartData} />);
}
