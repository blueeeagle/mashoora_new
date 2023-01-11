import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
import { getDatabase, set, ref, push, child, onValue, onChildAdded, get, onChildChanged } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-database.js";

  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyC_M76lU8RE624MA7SCFS98rM4It8M_goM",
    authDomain: "chat-app-73436.firebaseapp.com",
    databaseURL: "https://chat-app-73436-default-rtdb.firebaseio.com",
    projectId: "chat-app-73436",
    storageBucket: "chat-app-73436.appspot.com",
    messagingSenderId: "519052902476",
    appId: "1:519052902476:web:d02c47f9423f863aeb34e9",
    measurementId: "G-H71QBFEDQ0"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const DATABASE = getDatabase(app)
    // firebase.database().ref('messages').push(({
    //     "sender":'arun',
    //     'message':'Arun'
    // }))

    onChildChanged(ref(DATABASE, 'messages/customer'),(data)=>{
        Customer.firebaseconversionEvent(data)
    })
    onChildChanged(ref(DATABASE, 'messages/consultant'),(data)=>{
        Consultant.firebaseconversionEvent(data)
    })
    onChildAdded(ref(DATABASE, 'messages/customer'),(data)=>{
        Customer.firebaseconversionEvent(data)
    })
    onChildAdded(ref(DATABASE, 'messages/consultant'),(data)=>{
        Consultant.firebaseconversionEvent(data)
    })
var chatopenclose = new Vue({
    el : '#chatopenclose',
    data :{
        ActiveBitton : 'btn btn-sm btn-primary',
        NoActivebutton : 'btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold',
        CustomerButton : true,
        ConsultantButton : false,
    },
    methods : {
        tootlebutton(){
            this.CustomerButton = !this.CustomerButton
            this.ConsultantButton = !this.ConsultantButton
            Customer.customerChatActive =  this.CustomerButton
            Consultant.consultantChatActive =  this.ConsultantButton
        }
    }

})
var Customer = new Vue({
    el: '#customer',
    data:{
        customers : [],
        ActiveCustomer : null,
        message : null,
        Firebaseurl : null,
        conversion : [],
        notifivation : [],
        search : '',
        customerChatActive : true
    },
    mounted(){
        fetch(CustomerURL)
        .then(response => response.json())
        .then(data => {
            Customer.customers = data?.customer || []
            Customer.customers.forEach((element,index) => {
                Customer.customers[index]['Firebaseurl'] = `messages/customer/${element.phone_no}/`
                Customer.customers[index].larstconversion = ''
                Customer.notifivation.push({'count':0,'countStatus':false,'filtered':true})

            });
        })
    },
    watch : {
    },
    methods : {
        searchData(event){
            this.customers.forEach((element,index) => {

                if(String(element.name).includes(event.target.value) || String(element.email).includes(event.target.value)){
                    this.notifivation[index].filtered = true;
                }else{
                    this.notifivation[index].filtered = false;
                }
            })
        },
        SetCustomer(index){
            this.ActiveCustomer = this.customers[index]
            this.conversion = [];
            this.notifivation[index].count = 0
            this.notifivation[index].countStatus = false;
            const dbRef = ref(getDatabase());
            get(child(dbRef,Customer.customers[index]['Firebaseurl'])).then((snapshot) =>{
                if(snapshot.exists()){
                    const value = snapshot.val()
                    for (var V in value) {
                        this.conversion.push(value[V])
                    }
                }
            })
            document.querySelector('[data-kt-element=messages]').scrollTop = document.querySelector('[data-kt-element=messages]').scrollHeight
        },
        Sentmessage(){
            if(this.ActiveCustomer){
                push(ref(DATABASE, this.ActiveCustomer.Firebaseurl),{
                    message:Customer.message,
                    sender : 'Admin',
                    to : this.ActiveCustomer.name || 'Customer',
                    id : this.ActiveCustomer.id,
                })
                Customer.message =''
            }
        },

        firebaseconversionEvent(data){
            const ChatData = data.val();
            const Key = Object.keys(ChatData)[Object.keys(ChatData).length - 1]
            const value = ChatData[Key]
            if(this.ActiveCustomer){
                if(this.ActiveCustomer.id == value.id) {
                    this.conversion.push(value)
                    document.querySelector('[data-kt-element=messages]').scrollTop = document.querySelector('[data-kt-element=messages]').scrollHeight
                }
                else{
                    this.customers.forEach((element,index) => {
                        if(element.id == value.id){
                            this.notifivation[index].count += 1;
                            this.notifivation[index].countStatus = true;
                        }
                    })
                }
            }else{
                this.customers.forEach((element,index) => {
                    if(element.id == value.id){
                        this.notifivation[index].count += 1;
                        this.notifivation[index].countStatus = true;

                    }
                })
            }
        }
    }

})
var Consultant = new Vue({
    el: '#consultant',
    data:{
        consultants : [],
        ActiveConsultant : null,
        message : null,
        Firebaseurl : null,
        conversion : [],
        notifivation : [],
        search : '',
        consultantChatActive : false
    },
    mounted(){
        fetch(ConsultantURL)
        .then(response => response.json())
        .then(data => {
            Consultant.consultants = data?.customer || []
            Consultant.consultants.forEach((element,index) => {
                Consultant.consultants[index]['Firebaseurl'] = `messages/consultant/${element.phone_no}/`
                Consultant.consultants[index].larstconversion = ''
                Consultant.notifivation.push({'count':0,'countStatus':false,'filtered':true})

            });
        })
    },
    watch : {
    },
    methods : {
        searchData(event){
            this.consultants.forEach((element,index) => {

                if(String(element.name).includes(event.target.value) || String(element.email).includes(event.target.value)){
                    this.notifivation[index].filtered = true;
                }else{
                    this.notifivation[index].filtered = false;
                }
            })
        },
        SetConsultant(index){
            this.ActiveConsultant = this.consultants[index]
            this.conversion = [];
            this.notifivation[index].count = 0
            this.notifivation[index].countStatus = false;
            const dbRef = ref(getDatabase());
            get(child(dbRef,Consultant.consultants[index]['Firebaseurl'])).then((snapshot) =>{
                if(snapshot.exists()){
                    const value = snapshot.val()
                    for (var V in value) {
                        this.conversion.push(value[V])
                    }
                }
            })
            document.querySelector('[data-kt-element=messages-consultant]').scrollTop = document.querySelector('[data-kt-element=messages-consultant]').scrollHeight
        },
        Sentmessage(){
            if(this.ActiveConsultant){
                push(ref(DATABASE, this.ActiveConsultant.Firebaseurl),{
                    message:Consultant.message,
                    sender : 'Admin',
                    to : this.ActiveConsultant.name || 'Consultants',
                    id : this.ActiveConsultant.id,
                })
                Consultant.message =''
            }
        },

        firebaseconversionEvent(data){
            const ChatData = data.val();
            const Key = Object.keys(ChatData)[Object.keys(ChatData).length - 1]
            const value = ChatData[Key]
            if(this.ActiveConsultant){
                if(this.ActiveConsultant.id == value.id) {
                    this.conversion.push(value)
                    document.querySelector('[data-kt-element=messages-consultant]').scrollTop = document.querySelector('[data-kt-element=messages-consultant]').scrollHeight
                }
                else{
                    this.consultants.forEach((element,index) => {
                        if(element.id == value.id){
                            this.notifivation[index].count += 1;
                            this.notifivation[index].countStatus = true;
                        }
                    })
                }
            }else{
                this.consultants.forEach((element,index) => {
                    if(element.id == value.id){
                        this.notifivation[index].count += 1;
                        this.notifivation[index].countStatus = true;

                    }
                })
            }

        }
    }

})
