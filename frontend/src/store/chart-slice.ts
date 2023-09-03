import { createSlice } from '@reduxjs/toolkit'


interface IIntialState {
    data: Object,
}

const initialState: IIntialState = {
  data: {},
}

export const chartSlice = createSlice({
  name: 'chart',
  initialState,
  reducers: {
  },
})

export const chartActions = chartSlice.actions

export default chartSlice.reducer