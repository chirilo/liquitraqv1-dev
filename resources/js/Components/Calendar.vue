<script>
import { defineComponent, defineProps, toRefs, ref, onMounted } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
//import { INITIAL_EVENTS, createEventId } from './event-utils'
import { createEventId } from './event-utils'



const props = ['liquijobs'];

// //const { myProp } = toRefs(props);
//console.log('propssss'+props.liquijobs);

let todayStr = new Date().toISOString().replace(/T.*$/, '') // YYYY-MM-DD of today
const INITIAL_EVENTS = [
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

// const eventss = ref([])
// onMounted(async () => {
//   await axios
//     .get('/api/events')
//     .then(response => {
//       console.log('resssss'+response);
//       eventss = response.data.message
//       //console.log('response data'+response.data);
//     })
// })
// console.log('eventssss response: '+eventss);

// console.log(JSON.stringify(eventss));
//console.log(INITIAL_EVENTS);

// mounted() {
//         axios.get('http://127.0.0.1:8000/api/')
//             .then(response => {
//                 this.results = response.data.results
//             })
//     }

export default defineComponent({
  components: {
    FullCalendar,
  },
  data() {
    return {
      //eventss: [],
      calendarOptions: {
        plugins: [
          dayGridPlugin,
          timeGridPlugin,
          interactionPlugin // needed for dateClick
        ],
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        height: 'auto',
        //initialEvents: INITIAL_EVENTS, // alternatively, use the `events` setting to fetch from a feed
        events: 'http://127.0.0.1:8000/api/events',
        //initialEvents: this.eventss,
        editable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        weekends: true,
        select: this.handleDateSelect,
        eventClick: this.handleEventClick,
        eventsSet: this.handleEvents
        /* you can update a remote database when these fire:
        eventAdd:
        eventChange:
        eventRemove:
        */
      },
      currentEvents: ['asd'],
      
    }
  },
  mounted() {
        axios.get('/api/events')
            .then(response => {
                this.eventss = response.data.message
                this.initialEvents = response.data.message
                console.log('eventss'+response.data.message)
            })
    },
  methods: {
    handleWeekendsToggle() {
      this.calendarOptions.weekends = !this.calendarOptions.weekends // update a property
    },
    handleDateSelect(selectInfo) {
      let title = prompt('Please enter a new title for your event')
      let calendarApi = selectInfo.view.calendar

      calendarApi.unselect() // clear date selection

      if (title) {
        calendarApi.addEvent({
          id: createEventId(),
          title,
          start: selectInfo.startStr,
          end: selectInfo.endStr,
          allDay: selectInfo.allDay
        })
      }
    },
    handleEventClick(clickInfo) {
      if (confirm(`Job: '${clickInfo.event.title}'`)) {
        clickInfo.event.remove()
      }
    },
    handleEvents(events) {
      this.currentEvents = events
    },
  }
})

</script>

<template>
  <div class='demo-app'>
    <!--<div class='demo-app-sidebar' style="display:none;">
      <div class='demo-app-sidebar-section'>
        <h2>Instructions</h2>
        <ul>
          <li>Select dates and you will be prompted to create a new event</li>
          <li>Drag, drop, and resize events</li>
          <li>Click an event to delete it</li>
        </ul>
      </div>
      <div class='demo-app-sidebar-section'>
        <label>
          <input
            type='checkbox'
            :checked='calendarOptions.weekends'
            @change='handleWeekendsToggle'
          />
          toggle weekends
        </label>
      </div>
      <div class='demo-app-sidebar-section'>
        <h2>All Events ({{ currentEvents.length }})</h2>
        <ul>
          <li v-for='event in currentEvents' :key='event.id'>
            <b>{{ event.startStr }}</b>
            <i>{{ event.title }}</i>
          </li>
        </ul>
      </div>
    </div>-->

    <div class='demo-app-main'>
      <FullCalendar
        class='demo-app-calendar'
        :options='calendarOptions'
      >
        <!-- <template v-slot:eventContent='arg'>
          <b>{{ arg.timeText }}</b>
          <i>{{ arg.event.title }}</i>
        </template> -->
        
      </FullCalendar>
      <template v-for="entry in eventss" :key="entry.id">
          <b>{{ entry.corporate_address }}</b>
          <i>{{ entry.start_date }}</i>
        </template>
        <ul>
          <li v-for="entry in eventss" :key="entry.id">
            <b>{{ entry.corporate_address }}</b>
          </li>
        </ul>
    </div>
  </div>
</template>

<style lang='css'>

h2 {
  margin: 0;
  font-size: 16px;
}

ul {
  margin: 0;
  padding: 0 0 0 1.5em;
}

li {
  margin: 1.5em 0;
  padding: 0;
}

b { /* used for event dates/times */
  margin-right: 3px;
}

.demo-app {
  display: flex;
  min-height: 100%;
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}

.demo-app-sidebar {
  width: 300px;
  line-height: 1.5;
  background: #eaf9ff;
  border-right: 1px solid #d3e2e8;
}

.demo-app-sidebar-section {
  padding: 2em;
}

.demo-app-main {
  flex-grow: 1;
  /* padding: 3em; */
}

.fc-toolbar-title {
  color: #00afef !important;
  font-family: RethinkSans-ExtraBold !important;
  text-transform: uppercase !important;
  font-size: 1.125rem !important;
  line-height: 1.75rem !important;

}
.fc { /* the calendar root */
  max-width: 1100px;
  margin: 0 auto;
}
/* removing today button */
/*.fc-today-button {
  display: none !important;
}
.fc-toolbar-chunk:nth-child(1), .fc-toolbar-chunk:nth-child(3) {
  display: none !important;
}
.fc-toolbar-chunk:nth-child(2) {
  width: 100% !important;
  text-align: center;
}*/
</style>