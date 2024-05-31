<template>
    <div>
        <button @click="saveDataOnly" class="mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-blue-700 transition ease-in-out duration-150">Create New Daatasd dfs</button>
        <button @click="saveandrefreshData" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition ease-in-out duration-150">RefreshData</button>
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
        // datacount : 0,
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

    // window.Echo = new Echo({
    // broadcaster: 'reverb',
    // key: import.meta.env.VITE_REVERB_APP_KEY,
    // wsHost: import.meta.env.VITE_REVERB_HOST,
    // wsPort: import.meta.env.VITE_REVERB_PORT,
    // wssPort: import.meta.env.VITE_REVERB_PORT,
    // forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    // enabledTransports: ['ws', 'wss'],
// });

// if (typeof window.Echo !== 'undefined') {
    //   window.Echo.channel('dashboard')
    //     .listen('.data.updated', (e) => {
    //       console.log(e);
    //       console.log('berhasil');
    //       this.updateData()
    //     });
    // }
    
  },

    methods: {
      saveDataOnly() {
      // Your code here
    //   console.log('test');
      Axios.post('/storeuser', { message: 'test' })
        .then(response => {
            console.log(response.data);
            console.log(response);
            // Clear the input field after sending
            // messageInput.value = '';
        })
        .catch(error => console.error(error));
    console.log('sent messages');
    },

    saveandrefreshData() {
      // Your code here
    //   console.log('test');
      Axios.get('/refreshdata', { message: 'test' })
        .then(response => {
            console.log(response.data);
            console.log(response);
            // Clear the input field after sending
            // messageInput.value = '';
        })
        .catch(error => console.error(error));
    console.log('sent messages');
    },

    // updateData(){
    //     Axios.get('/get/data', { message: 'test' })
    //     .then(response => {
    //         console.log(response.data);
    //         this.datacount = response.data
    //         console.log(response);
    //         // Clear the input field after sending
    //         // messageInput.value = '';
    //     })
    //     .catch(error => console.error(error));
    // }
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