import { configureStore } from '@reduxjs/toolkit';
import chart from './chart-slice';
const store = configureStore({
  reducer: {
    chart
  },
})

export default store;