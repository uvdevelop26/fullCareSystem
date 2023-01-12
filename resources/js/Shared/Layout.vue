<template>
  <div>
    <!-- Modal Teletransportado -->
    <div id="dropdown" />
    <!-- Encabezado con logo -->
    <div class="md:flex md:flex-col">
        <div class="md:flex md:flex-col md:h-screen">
            <div class="md:flex md:flex-shrink-0">
                <div class="flex items-center justify-between px-6 py-4 bg-cyan-900 md:flex-shrink-0 md:justify-center md:w-56">
                    <Link class="mt-1 flex" href="/">
                        <fullcare-logo class="fill-white text-white" width="30" height="30" />
                        <span class="text-white mt-1 ml-1"><strong>FullCare</strong>System</span>
                    </Link>
                    <!-- Dropdown con los links -->
                    <dropdown-menu class="md:hidden" placement="bottom-end">
                        <template #default>
                            <svg class="w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
                        </template>
                        <template #dropdown>
                        <div class="mt-2 px-8 py-4 bg-cyan-800 rounded shadow-lg">
                           <main-menu />
                        </div>
                    </template>
                    </dropdown-menu>
                </div>
                <div class="md:text-md flex items-center justify-between p-4 w-full text-sm bg-white border-b md:px-12 md:py-0">
                    <div class="mr-4 mt-1 text-cyan-800 italic">Frase o pagina activa</div>
                    <!-- Dropdown con las opciones de usuario -->
                    <dropdown-menu class="mt-1" placement="bottom-end">
                        <template #default>
                            <div class="group flex items-center cursor-pointer select-none">
                                <div class="mr-1 text-gray-700 group-hover:text-cyan-600 focus:text-cyan-600 whitespace-nowrap">
                                    <span>{{ $page.props.user.username }}</span>
                                </div>
                                <icon class="w-5 h-5 fill-gray-700 group-hover:fill-cyan-600 focus:fill-cyan-600" name="cheveron-down" />
                            </div>
                        </template>
                        <template #dropdown>
                            <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                                <Link class="block px-6 py-2 hover:text-white hover:bg-cyan-500" :href="route('profile.show')" >Mi Perfil</Link>
                                <form @submit.prevent="logout" method="POST">
                                  <Link class="block px-6 py-2 w-full text-left hover:text-white hover:bg-cyan-500" href="/logout" method="POST" as="button" >Logout</Link>
                                </form>
                            </div>
                        </template>
                    </dropdown-menu>
                </div>
            </div>
            <div class="md:flex md:flex-grow md:overflow-hidden bg-gray-50">
                <main-menu class="hidden flex-shrink-0 p-7 w-56 bg-cyan-800 overflow-y-auto md:block" />
                <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" scroll-region>
                    <flash-messages />
                    <slot />    
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import FullcareLogo from '../Shared/FullcareLogo.vue'
import DropdownMenu from '../Shared/DropdownMenu.vue'
import MainMenu from '../Shared/MainMenu.vue'
import Icon from '../Shared/Icon.vue'
import FlashMessages from '../Shared/FlashMessages.vue'
export default {

    components: {
        Link,
        FullcareLogo,
        DropdownMenu,
        MainMenu,
        Icon,
        FlashMessages
    },

    props: {
        auth: Object,
    },

   

}
</script>

<style>

</style>