<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror, succes } from '@/Helper/Toast';
import { User, UserStar, IdCard, Mail, Phone, PhoneForwarded, MapPin } from 'lucide-vue-next';

const props = defineProps(['user']);
const loading = ref(false);
const form = ref({
    name: '',
    username: '',
    nik: '',
    email: '',
    gender: '',
    birthday: '',
    phone: '',
    emergency: '',
    city: '',
    address: '',
})
const errors = ref({})
const submit = async () => {
    try {
        loading.value = true;
        const response = await axios.patch(`/api/profile/update/${props?.user?.id}`, form.value);
        succes('Success!', 'Your profile updated')
    } catch (error) {
        if(error?.response?.status == 422){
            errors.value = error?.response?.data?.errors
        }else{
            eror('Error!', error?.response?.data?.message);
        }
    }finally {
        loading.value = false;
    }
}
onMounted(()=>{
    console.log(props.user);
    form.value.name = props?.user?.name;
    form.value.username = props?.user?.username;
    form.value.nik = props?.user?.nik;
    form.value.email = props?.user?.email;
    form.value.gender = props?.user?.gender;
    form.value.birthday = props?.user?.birthday;
    form.value.phone = props?.user?.phone;
    form.value.emergency = props?.user?.emergency;
    form.value.city = props?.user?.city;
    form.value.address = props?.user?.address;
})
</script>

<template>
    <form @submit.prevent="submit" class="p-4 md:p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-2.5">
            <div>
                <div>
                    <InputLabel>
                        Name
                    </InputLabel>
                    <div class="flex items-center max-h-max justify-start rounded-lg border-1 border-gray-200 ring-1 ring-gray-100 px-3 my-1.5 focus-within:border-gray-300 focus-within:ring-gray-200 focus-within:shadow-sm group">
                        <User size="20" class="text-slate-400 group-focus-within:text-slate-500" />
                        <input
                            type="text"
                            class="w-full border-0 focus:border-0 focus:ring-0"
                            v-model="form.name"
                            autocomplete="name"
                            
                            placeholder="Enter your name"
                        />
                    </div>
                    <p v-if="errors.name" class="text-red-400 text-xs font-second">{{ errors?.name[0] }}</p>
                </div>

                <div>
                    <InputLabel>
                        Username
                    </InputLabel>
                    <div class="flex items-center max-h-max justify-start rounded-lg border-1 border-gray-200 ring-1 ring-gray-100 px-3 my-1.5 focus-within:border-gray-300 focus-within:ring-gray-200 focus-within:shadow-sm group">
                        <UserStar size="20" class="text-slate-400 group-focus-within:text-slate-500" />
                        <input
                            type="text"
                            class="w-full border-0 focus:border-0 focus:ring-0"
                            v-model="form.username"
                            autocomplete="username"
                            
                            placeholder="Enter your username"
                        />
                    </div>
                    <p v-if="errors.username" class="text-red-400 text-xs font-second">{{ errors?.username[0] }}</p>
                </div>

                <div>
                    <InputLabel>
                        ID Number (NIK)
                    </InputLabel>
                    <div class="flex items-center max-h-max justify-start rounded-lg border-1 border-gray-200 ring-1 ring-gray-100 px-3 my-1.5 focus-within:border-gray-300 focus-within:ring-gray-200 focus-within:shadow-sm group">
                        <IdCard size="20" class="text-slate-400 group-focus-within:text-slate-500" />
                        <input
                            type="text"
                            class="w-full border-0 focus:border-0 focus:ring-0"
                            v-model="form.nik"
                            autocomplete="nik"
                            
                            placeholder="Enter your ID Number / NIK"
                        />
                    </div>
                    <p v-if="errors?.nik" class="text-red-400 text-xs font-second">{{ errors?.nik[0] }}</p>
                </div>

                <div>
                    <InputLabel>
                        Email
                    </InputLabel>
                    <div class="flex items-center max-h-max justify-start rounded-lg border-1 border-gray-200 ring-1 ring-gray-100 px-3 my-1.5 focus-within:border-gray-300 focus-within:ring-gray-200 focus-within:shadow-sm group">
                        <Mail size="20" class="text-slate-400 group-focus-within:text-slate-500" />
                        <input
                            type="email"
                            class="w-full border-0 focus:border-0 focus:ring-0"
                            v-model="form.email"
                            autocomplete="name"
                            
                            placeholder="Enter your email"
                        />
                    </div>
                    <p v-if="errors?.email" class="text-red-400 text-xs font-second">{{ errors?.email[0] }}</p>
                </div>

                <div>
                    <InputLabel>
                        Date of birthday
                    </InputLabel>
                    <div class="max-h-max rounded-lg border-1 border-gray-200 ring-1 ring-gray-100 px-3 my-1.5 focus-within:border-gray-300 focus-within:ring-gray-200 focus-within:shadow-sm group">
                        <input
                            type="date"
                            class="w-full border-0 focus:border-0 focus:ring-0"
                            v-model="form.birthday"
                            autocomplete="birthday"
                        />
                    </div>
                    <p v-if="errors?.birthday" class="text-red-400 text-xs font-second">{{ errors?.birthday[0] }}</p>
                </div>
            </div>

            <div>
                <div>
                    <InputLabel>
                        Phone
                    </InputLabel>
                    <div class="flex items-center max-h-max justify-start rounded-lg border-1 border-gray-200 ring-1 ring-gray-100 px-3 my-1.5 focus-within:border-gray-300 focus-within:ring-gray-200 focus-within:shadow-sm group">
                        <Phone size="20" class="text-slate-400 group-focus-within:text-slate-500" />
                        <input
                            type="text"
                            class="w-full border-0 focus:border-0 focus:ring-0"
                            v-model="form.phone"
                            autocomplete="phone"
                            
                            placeholder="Enter your phone"
                        />
                    </div>
                    <p v-if="errors.phone" class="text-red-400 text-xs font-second">{{ errors?.phone[0] }}</p>
                </div>

                <div>
                    <InputLabel>
                        Emergency Phone
                    </InputLabel>
                    <div class="flex items-center max-h-max justify-start rounded-lg border-1 border-gray-200 ring-1 ring-gray-100 px-3 my-1.5 focus-within:border-gray-300 focus-within:ring-gray-200 focus-within:shadow-sm group">
                        <PhoneForwarded size="20" class="text-slate-400 group-focus-within:text-slate-500" />
                        <input
                            type="text"
                            class="w-full border-0 focus:border-0 focus:ring-0"
                            v-model="form.emergency"
                            autocomplete="emergency"
                            
                            placeholder="Enter your emergency phone"
                        />
                    </div>
                    <p v-if="errors.emergency" class="text-red-400 text-xs font-second">{{ errors?.emergency[0] }}</p>
                </div>

                <div>
                    <InputLabel>
                        City
                    </InputLabel>
                    <div class="flex items-center max-h-max justify-start rounded-lg border-1 border-gray-200 ring-1 ring-gray-100 px-3 my-1.5 focus-within:border-gray-300 focus-within:ring-gray-200 focus-within:shadow-sm group">
                        <MapPin size="20" class="text-slate-400 group-focus-within:text-slate-500" />
                        <input
                            type="text"
                            class="w-full border-0 focus:border-0 focus:ring-0"
                            v-model="form.city"
                            autocomplete="city"
                            
                            placeholder="Enter your city"
                        />
                    </div>
                    <p v-if="errors.city" class="text-red-400 text-xs font-second">{{ errors?.city[0] }}</p>
                </div>

                <div>
                    <InputLabel>
                        Address
                    </InputLabel>
                    <textarea v-model="form.address" class="rounded-lg border-1 w-full border-gray-200 ring-1 ring-gray-100 px-3 my-1.5 focus-within:border-gray-300 focus-within:ring-gray-200 focus-within:shadow-sm"></textarea>
                    <p v-if="errors?.address" class="text-red-400 text-xs font-second">{{ errors?.address[0] }}</p>
                </div>

                <div>
                    <InputLabel>
                        Gender
                    </InputLabel>
                    <div class="grid grid-cols-2 gap-3">
                        <label for="male" class="text-slate-800">
                            <input v-model="form.gender" type="radio" name="gender" id="male" value="male">
                            Male
                        </label>

                        <label for="female" class="text-slate-800">
                            <input v-model="form.gender" type="radio" name="gender" id="female" value="female">
                            Female
                        </label>
                    </div>
                    <p v-if="errors?.gender" class="text-red-400 text-xs font-second">{{ errors?.gender[0] }}</p>
                </div>
            </div>
        </div>
        <button type="submit" :disabled="loading" :class="[loading ? 'cursor-not-allowed opacity-50' : 'cursor-pointer opacity-100', 'bg-blue-500 text-white px-5 py-2 font-second rounded-lg w-full my-2 flex items-center justify-center hover:bg-blue-600 transition-all duration-200']">
            <svg v-show="!loading" class="fill-current mx-2.5" width="15px" height="18px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
            <path d="M37.1,4v13.6c0,1-0.8,1.9-1.9,1.9H13.9c-1,0-1.9-0.8-1.9-1.9V4H8C5.8,4,4,5.8,4,8v36c0,2.2,1.8,4,4,4h36
                c2.2,0,4-1.8,4-4V11.2L40.8,4H37.1z M44.1,42.1c0,1-0.8,1.9-1.9,1.9H9.9c-1,0-1.9-0.8-1.9-1.9V25.4c0-1,0.8-1.9,1.9-1.9h32.3
                c1,0,1.9,0.8,1.9,1.9V42.1z"/>
            <g>
                <path d="M24.8,13.6c0,1,0.8,1.9,1.9,1.9h4.6c1,0,1.9-0.8,1.9-1.9V4h-8.3L24.8,13.6L24.8,13.6z"/>
            </g>
            </svg>
            {{ loading ? 'Saving' : 'Edit Profile' }}
        </button>
    </form>
</template>