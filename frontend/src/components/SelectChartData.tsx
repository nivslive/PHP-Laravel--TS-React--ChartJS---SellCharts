import axios, { AxiosResponse } from 'axios';
import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { chartActions } from '../store/chart-slice';

export default function SelectChartData() {
  const [selectedOption, setSelectedOption] = useState('all'); // Valor padrão: "all" para "Todos os anos"
  const dispatch = useDispatch();
  const selector = useSelector((store:any) => store.chart)
  useEffect(() => {
  console.log(selector, 'selector');
  }, [selectedOption]);

  const handleSelectChange = (e: any) => {
    setSelectedOption(e.target.value);
    dispatch(chartActions.putSelectedData(e.target.value));
    const urlPath: string = `http://localhost/api/sells/${(selectedOption === 'all' || selectedOption === '') ? 'all' : 'year/' + selectedOption}`;
    console.log(urlPath, 'urlPath')
    axios.get(urlPath)
        .then(( response : AxiosResponse ) => {
          // Processar os dados da resposta da API
          const apiData: 
            { periods: string[]; 
              total_price_sells: number[]; 
              sell_forecasts: number[], 
              product_counts: number[] 
            } = response.data;
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
          }

          if(selectedOption === 'all') {
            dispatch(chartActions.putAllData(updatedData));
          } else {
            console.log({data: updatedData, year: selectedOption}, 'by year')
            dispatch(chartActions.putDataByYear({data: updatedData, year: selectedOption}));
          }

        })
        .catch((error) => {
          console.error('Erro ao buscar dados da API:', error);
        });
  }

  return (
    <div>
      <label htmlFor="yearSelect">Selecione um ano:</label>
      <select
        id="yearSelect"
        value={selectedOption}
        onChange={handleSelectChange}
      >
        <option value="all">Todos os anos</option>
        <option value="2022">2022</option>
        <option value="2021">2021</option>
        <option value="2020">2020</option>
      </select>
    </div>
  );
}
