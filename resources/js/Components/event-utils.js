
let eventGuid = 0
let todayStr = new Date().toISOString().replace(/T.*$/, '') // YYYY-MM-DD of today

export const INITIAL_EVENTS = [
  {
    id: 1,
    title: 'Building: update one',
    start: '2025-05-29'
  },
  {
    id: 2,
    title: 'Building: Manchester UK',
    start: '2025-05-28'
  },
  {
    id: 2,
    title: 'Building: Birmingham, United Kingdom',
    start: '2025-06-28'
  },
  {
    id: 2,
    title: 'Building: Tulsa okhloma',
    start: '2025-05-26'
  },
  {
    id: 2,
    title: 'Building: Tulsa okhloma',
    start: '2025-05-26'
  },
  {
    id: 2,
    title: 'Building: this is the test address',
    start: '2025-07-03'
  },
  {
    id: 2,
    title: 'Building: New Job Testing',
    start: '2025-08-01'
  }
]

export function createEventId() {
  return String(eventGuid++)
}