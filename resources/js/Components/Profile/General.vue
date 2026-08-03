<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import { eror, succes } from '@/Helper/Toast';
const user = usePage().props.auth?.user;

const loading = ref(false);
const form = ref({
    first_name: '',
    last_name: '',
    middle_name: '',
    email: '',
    phone: '',
    gender: '',
    date_of_birth: '',
    address: ''
})
const errors = ref({})
const submit = async () => {
    try {
        loading.value = true;
        const response = await axios.patch(`/api/profile/update/${user.id}`, form.value);
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
    form.value.first_name = user.first_name
    form.value.last_name = user.last_name;
    form.value.middle_name = user.middle_name;
    form.value.email = user.email;
    form.value.phone = user.phone;
    form.value.gender = user.gender;
    form.value.address = user.address;
    form.value.date_of_birth = user.birthday;
})
</script>

<template>
    <form @submit.prevent="submit" class="p-4 md:p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <div>
                    <InputLabel>
                        First Name
                    </InputLabel>
                    <TextInput
                        type="text"
                        class="my-1 mx-2 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500"
                        v-model="form.first_name"
                        autocomplete="firstname"
                        
                        placeholder="Enter your first name"
                    />
                    <InputError class="mt-2" :message="errors?.first_name?.[0]" />
                </div>

                <div>
                    <InputLabel>
                        Last Name
                    </InputLabel>
                    <TextInput
                        type="text"
                        class="my-1 mx-2 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500"
                        v-model="form.last_name"
                        autocomplete="lastname"
                        placeholder="Enter your last name"
                    />
                    <InputError class="mt-2" :message="errors?.last_name?.[0]" />
                </div>

                <div>
                    <InputLabel>
                        Gender
                    </InputLabel>
                    <select class="my-1 mx-2 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500" v-model="form.gender">
                        <option value="" disabled>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <InputError class="mt-2" :message="errors?.gender?.[0]" />
                </div>

                <div>
                    <InputLabel>
                        Date of Birth
                    </InputLabel>
                    <TextInput
                        type="date"
                        v-model="form.date_of_birth"
                        class="my-1 mx-2 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500"
                    />
                    <InputError class="mt-2" :message="errors?.date_of_birth?.[0]" />
                </div>
            </div>

            <div>
                <div>
                    <InputLabel>
                        Middle Name
                    </InputLabel>
                    <TextInput
                        type="text"
                        class="my-1 mx-2 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500"
                        v-model="form.middle_name"
                        autocomplete="middlename"
                        placeholder="Enter your middle name"
                    />
                    <InputError class="mt-2" :message="errors?.middle_name?.[0]" />
                </div>

                <div>
                    <InputLabel>
                        Email
                    </InputLabel>
                    <TextInput
                        type="email"
                        class="my-1 mx-2 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500"
                        v-model="form.email"
                        autocomplete="email"
                        placeholder="Enter your email address"
                    />
                    <InputError class="mt-2" :message="errors?.email?.[0]" />
                </div>

                <div>
                    <InputLabel>
                        Phone
                    </InputLabel>
                    <div class="flex w-full">
                        <div class="my-1 mr-2 rounded-md border-gray-300 flex items-center justify-center">
                            <span>
                                +62
                            </span>
                        </div>
                        <TextInput
                            type="tel"
                            class="my-1 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500"
                            v-model="form.phone"
                            autocomplete="phone"
                            placeholder="Enter your phone number"
                        />
                    </div>
                    <InputError class="mt-2" :message="errors?.phone?.[0]" />
                </div>

                <div>
                    <InputLabel>
                        Address
                    </InputLabel>
                    <textarea class="my-1 mx-2 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500" v-model="form.address" placeholder="Enter your address"></textarea>
                    <InputError class="mt-2" :message="errors?.address?.[0]" />
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