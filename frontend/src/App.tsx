import React from 'react';
import logo from './logo.svg';
import './App.css';
import Chart from './components/Chart';
import SelectChartData from './components/SelectChartData';

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <SelectChartData/>
        <Chart/>
      </header>
    </div>
  );
}

export default App;
