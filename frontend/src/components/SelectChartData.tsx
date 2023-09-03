import React, { useState } from 'react';

export default function SelectChartData() {
  const [selectedOption, setSelectedOption] = useState('all'); // Valor padrão: "all" para "Todos os anos"

  const handleSelectChange = (e: any) => {
    setSelectedOption(e.target.value);
    // Aqui você pode adicionar lógica para atualizar o gráfico com a opção selecionada
  };

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
        {/* Adicione outras opções de anos, se necessário */}
      </select>
    </div>
  );
}
