<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
//import AuthenticationCard from '@/Components/AuthenticationCard.vue';
//import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import FullcareLogo from '../../Shared/FullcareLogo.vue';
import AuthenticationCardNew from '../../Shared/AuthenticationCardNew.vue';
import Icon from '../../Shared/Icon.vue';
import InputLabelNew from '../../Shared/InputLabelNew.vue'
import Coworking from '../../Shared/Coworking.vue';


defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    username: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Log in" />
    <div class=" px-7 pt-10 mx-auto h-screen w-screen flex justify-center items-center overflow-y-auto bg-turquesa">
        <authentication-card-new>
            <template #logo>
                <fullcare-logo class="w-4 h-4 mx-1 mb-1 inline " />
                <span class="font-bold text-indigo-400  text-md">FullCareSystem</span>
            </template>
            <template #image>
                <div class="md:text-center">
                    <Coworking name="coworking" class="w-60 h-60 md:my-3" />
                </div>
            </template>
            <div v-if="status" class="mb-4 font-medium text-sm">
                {{ status }}
            </div>
            <template #welcome>
                <h1 class="py-2 md:py-3 text-center text-2xl text-turquesa font-bold">¡Bienvenido!</h1>
            </template>
            <form @submit.prevent="submit">
                <div>
                    <InputLabelNew for="username" value="Usuario" />
                    <TextInput id="username" v-model="form.username" type="text" class="mt-1 block w-full" required
                        autofocus />
                    <InputError class="mt-2" :message="form.errors.username" />
                </div>

                <div class="mt-4">
                    <InputLabelNew for="password" value="Password" />
                    <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required
                        autocomplete="current-password" />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox v-model:checked="form.remember" name="remember" />
                        <span class="ml-2 text-sm">Recuerdame</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link v-if="canResetPassword" :href="route('password.request')"
                        class="underline text-sm hover:text-gray-900">
                    Olvidaste tu contraseña?
                    </Link>

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Ingresar
                    </PrimaryButton>
                </div>
            </form>
        </authentication-card-new>
    </div>
</template>
