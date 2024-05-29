<template>
    <div class=" w-full">
        <div class="">Count Data Realtimes</div>
        <div class="h-24 grid-cols-4 flex gap-4">
            <div class="bg-red-200">1</div>
            <div class="bg-blue-200">2</div>
            <div class="bg-yellow-200">3</div>
            <div class="bg-green-200">{{datacount}}</div>
        </div>
        <button @click="sendMessage" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition ease-in-out duration-150">Send Message</button>
    </div>
</template>

<script>


import Axios from 'axios'
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
export default {
    components: {
   
    },
    props: {
    

    },

    data() {
        return {
        datacount : 0,
        form: {
        }
        }
    },

    // mounted () {

    //     Echo.channel('dashboard')
    //         .listen('.data.updated', (e) => {
    //         console.log(e);
    //         console.log('berhasil terima');

    //     // window.Echo.channel('dashboard')
    //     //     .listen('.data.updated', (e) => {
    //     //     console.log(e);
    //     //     console.log('berhasil terima');
    //     // Append the new message to the chatroom
    //     // const messages = document.getElementById('messages');
    //     // const messageElement = document.createElement('p');
    //     // messageElement.innerText = e.message;
    //     // messages.appendChild(messageElement);
    //     });

        
    // },
  
    mounted() {
    // if (typeof window.Echo !== 'dashboard') {
    //   window.Echo.channel('dashboard')
    //     .listen('.YourEvent', (e) => {
    //       console.log(e);
    //     });
    // }

    window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

// if (typeof window.Echo !== 'undefined') {
      window.Echo.channel('dashboard')
        .listen('.data.updated', (e) => {
          console.log(e);
          console.log('berhasil');
          this.updateData()
        });
    // }
    
  },

    methods: {
    sendMessage() {
      // Your code here
    //   console.log('test');
      Axios.post('/store', { message: 'test' })
        .then(response => {
            console.log(response.data);
            console.log(response);
            // Clear the input field after sending
            // messageInput.value = '';
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
            // Clear the input field after sending
            // messageInput.value = '';
        })
        .catch(error => console.error(error));
    }
  }

    // methods: {

    //     sendMessage(){
            
    //         // console.log('test');
    //       Axios.get(route('get.allprovince'))
    //       .then(res => {
    //         this.searchCity.optiondata[0].options = res.data
    //       }).catch(error => {
    //         console.log(error.response.data.errors)
    //       })
        
    //     }

    //     // submit(){
    //     //     this.$inertia.post(this.route('final.quotation.store'), this.form, {
    //     //         onStart: () => this.sending = false,
    //     //         onFinish: () => this.sending = false,
    //     //       })
    //     // },
    // },

}
</script>