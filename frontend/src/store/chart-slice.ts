import { createSlice } from '@reduxjs/toolkit'


interface IIntialState {
    data: any,
    selectedData: string,
}

const initialState: IIntialState = {
  selectedData: '',
  data: {
    all: {},
    byYear: {},
  },
}

export const chartSlice = createSlice({
  name: 'chart',
  initialState,
  reducers: {
    putSelectedData(state, action) {
        state.selectedData = action.payload;
    },
    putAllData(state, action) {
        state.data.all = action.payload;
    },
    putDataByYear(state, action) {
        state.data['byYear'][action.payload.year] = action.payload.data;
    }
  },
})

export const chartActions = chartSlice.actions

export default chartSlice.reducer