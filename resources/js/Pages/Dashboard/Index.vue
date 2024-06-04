<template>
    <div>
    <div class="h-screen w-full relative">
      <div className="absolute  inset-0 h-full w-full bg-white bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px] [mask-image:radial-gradient(ellipse_50%_50%_at_50%_50%,#000_60%,transparent_100%)]"></div>
      <div class="absolute  inset-0 w-full">
          <div class="w-full flex items-center justify-center text-xl my-24">Count Data Realtimes</div>
          <div class="w-full flex mx-auto items-center justify-center grid-flow-row gap-12 p-12">
              <div class="w-full border border-white border-opacity-25 backdrop-blur-lg flex bg-blue-50 opacity-75 items-center justify-center h-48 text-4xl font-bold rounded-lg">1</div>
              <div class="w-full border border-white border-opacity-25 backdrop-blur-lg flex bg-blue-50 opacity-75 items-center justify-center h-48 text-4xl font-bold rounded-lg">2</div>
              <div class="w-full border border-white border-opacity-25 backdrop-blur-lg flex bg-blue-50 opacity-75 items-center justify-center h-48 text-4xl font-bold rounded-lg">3</div>
              <div class="w-full border border-white border-opacity-25 backdrop-blur-lg flex bg-blue-50 opacity-75 items-center justify-center h-48 text-4xl font-bold rounded-lg">
                <NumberAnimation
                  ref="number1"
	                :from=datacount
	                :to=updateddatacount
	                :format="theFormat"
	                :duration="1"
	                autoplay
                    easing='linear'
                />
              </div>
          </div>
          <div class="p-12 grid-flow-row flex grid-cols-2">
            <div class="w-full h-full">
              <!-- <apexchart height="300"  type="line" :options="chartOptions" :series="series" ></apexchart> -->
            </div>
            <div class="w-full h-full">
              <!-- <apexchart height="300"  type="line" :options="chartOptions" :series="series" ></apexchart> -->
            </div>
            <div>
            </div>
          </div>
      </div>
    </div>
      

      
    </div>
</template>

<script>


import Axios from 'axios'
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import NumberAnimation from "vue-number-animation";
// import VueApexCharts from "vue3-apexcharts";
export default {
    components: {
      // apexchart: VueApexCharts,
      NumberAnimation
    },
    props: {
    

    },

    data() {
        return {
        datacount : 0,
        updateddatacount : 0,

        chartOptions: {
        chart: {
          width: '100%',
          type: 'spline-line-chart',
          stacked: false,
         
          animations: {
            enabled: true,
            easing: 'easeinout',
            speed: 700,
            animateGradually: {
                enabled: true,
                delay: 400
            },
            dynamicAnimation: {
                enabled: true,
                speed: 2000
            }
          },
        },
        stroke: {
          curve: 'smooth'
        },
        colors:['#672ab8','#375ab8'],
        xaxis: {
          categories: ['a'],
        },
        title: {
          text: 'Count Datas',
        },
        noData: {
          text: 'No Data Showed'
        },

        background: '#fff'

      },
      series: [
        {
          name: "series-1",
          data: [30, 40, 35, 50, 49, 60, 70, 91],
        },
        {
          name: "series-2",
          data: [30, 40, 35, 50, 49, 60, 70, 91],
        },
      ],

      series2: [
        {
          name: "series-1",
          data: [30, 40, 35, 50, 49, 60, 70, 91],
        },
      ],
        }
    },

    mounted() {
    window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

      window.Echo.channel('dashboard')
        .listen('.data.updated', (e) => {
          console.log(e);
          console.log('berhasil');
          this.updateddatacount = e.data
          this.series[0].data = e.array_data
          this.series[1].data = e.array_data2
        });
    
  },

    methods: {
      theFormat(number) {
      return number.toFixed(0);
    },
    sendMessage() {
      Axios.post('/store', { message: 'test' })
        .then(response => {
            console.log(response.data);
            console.log(response);
        })
        .catch(error => console.error(error));
    console.log('sent messages');
    },

    updateData(){
        Axios.get('/get/data', { message: 'test' })
        .then(response => {
            console.log(response.data);
            this.datacount = response.data
            console.log(response);
        })
        .catch(error => console.error(error));
    }
  }
}
</script>