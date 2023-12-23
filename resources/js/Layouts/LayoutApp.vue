<script setup>
import NavigationMenu from '../Shared/NavigationMenu.vue'
import Icon from '../Shared/Icon.vue';
import FullcareLogo from '../Shared/FullcareLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { ref, reactive, onMounted, onUnmounted } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';


//show and hide menu to logout 
const showUserDropdown = ref(false)


//variable to show/hide navbar depending on screen sizes
const isMobile = ref();
let mql

const props = defineProps({
    auth: Object,
})


//object for the menu
const menu = reactive([
    {
        id: 1,
        name: 'dashboard',
        icon_name: 'dashboard',
        href: '/dashboard',
        submenu: [],
        toggle_submenu: false

    },
    {
        id: 2,
        name: 'residentes',
        icon_name: 'residentes',
        submenu: [
            { name: 'admin. residentes', href: '/residentes', permiso: 'residentes-lista' },
            { name: 'estados residentes', href: '/estados', permiso: 'residentes-estados' },
            { name: 'admin. familiares', href: '/familiares', permiso: 'residentes-familiares' }
        ],
        toggle_submenu: false
    },
    {
        id: 3,
        name: 'empleados',
        icon_name: 'empleados',
        submenu: [
            { name: 'admin. empleados', href: '/empleados', permiso: 'empleados-lista' },
            { name: 'sueldos', href: '/sueldos', permiso: 'empleados-sueldos' },
            { name: 'jornadas laborales', href: '/jornadas', permiso: 'empleados-jornadas' },
            { name: 'solicitar permiso', href: '/permisos', permiso: 'empleados-permisos' },
            { name: 'solicitar vacación', href: '/vacaciones', permiso: 'empleados-vacaciones' }
        ],
        toggle_submenu: false

    },
    {
        id: 4,
        name: 'usuarios',
        icon_name: 'usuarios',
        submenu: [
            { name: 'admin. usuarios', href: '/usuarios', permiso: 'usuarios-lista' },
            { name: 'roles', href: '/roles', permiso: 'usuarios-roles' },
            { name: 'permisos de Acceso', href: '/permissions', permiso: 'usuarios-permissions' }
        ],
        toggle_submenu: false

    },
    {
        id: 5,
        name: 'finanzas',
        icon_name: 'ingresos',
        submenu: [
            { name: 'ingresos', href: '/ingresos', permiso: 'finanzas-ingresos' },
            { name: 'egresos', href: '/egresos', permiso: 'finanzas-egresos' },
            { name: 'balance', href: '/balance', permiso: 'finanzas-balances' }
        ],
        toggle_submenu: false

    },
    {
        id: 6,
        name: 'salud',
        icon_name: 'historial',
        submenu: [
            { name: 'historial clinico', href: '/historiales', permiso: 'salud-historiales' },
            { name: 'medicamentos', href: '/medicamentos', permiso: 'salud-medicamentos' },
            { name: 'rutinas', href: '/rutinas', permiso: 'salud-rutinas' },

        ],
        toggle_submenu: false

    },
    {
        id: 7,
        name: 'control',
        icon_name: 'control',
        submenu: [
            { name: 'marcar medicamentos', href: '/horario-medicamentos', permiso: 'marcar-med' },
            { name: 'marcar rutinas', href: '/horario-rutinas', permiso: 'marcar-rut' },
            { name: 'control medicamentos', href: '/control-medicamentos', permiso: 'control-med' },
            { name: 'control rutinas', href: '/control-rutinas', permiso: 'control-rut' }
        ],
        toggle_submenu: false

    },
    {
        id: 8,
        name: 'reportes',
        icon_name: 'reportes',
        href: '/reportes',
        submenu: [],
        toggle_submenu: false

    }
])

//permisos

const hasPermission = (permission) => {

    return props.auth.permissions.includes(permission)
}




//toggle submenus
const toggleSubMenu = (index) => {
    menu[index].toggle_submenu = !menu[index].toggle_submenu
}

//method to show and hide navbar depending on screem sizes
const handleMqlChange = (e) => {
    isMobile.value = e.matches
}


onMounted(() => {
    mql = window.matchMedia('(min-width: 768px)');
    isMobile.value = mql.matches

    mql.addEventListener('change', handleMqlChange)

})


onUnmounted(() => {
    mql.removeEventListener('change', handleMqlChange)

});


</script>

<template>
    <div>
        <div class="md:h-screen">
            <div class="md:flex md:flex-grow">
                <!-- COMPONENTE MENU DE NAVEGACIÓN -->
                <NavigationMenu>
                    <!-- LE PASA UN SLOT PARA EL ENCABEZADO -->
                    <template #header>
                        <div class="md:text-center">
                            <span class="text-white font-semibold drop-shadow-xl text-xl">
                                FullCareSystem
                            </span>
                            <FullcareLogo class="w-6 h-6 mb-2 inline" />
                        </div>
                        <div class="pt-1 text-right">
                            <button class="text-right md:hidden" @click="isMobile = !isMobile">
                                <Icon name='menu' :class="isMobile ? 'border' : ''"
                                    class="w-6 h-6 inline-block fill-white" />
                            </button>
                        </div>
                    </template>
                    <!-- LISTA DE BOTONES  -->
                    <transition name="slice">
                        <nav class="md:h-full md:flex md:flex-col md:justify-between" v-if="isMobile">
                            <!-- LISTA PRINCIPAL ETIQUET -->
                            <ul class="md:pt-4  md:h-full md:overflow-y-auto">
                                <template v-for="(item, index) in menu" :key="item.id">
                                    <li v-if="hasPermission(item.name)" class="py-2 px-3  md:mb-2"
                                        :class="{ 'bg-fondColor border-l-turquesa': $page.url.startsWith(item.href) }">
                                        <button v-if="item.submenu.length && hasPermission(item.name)"
                                            @click="toggleSubMenu(index)" class="group w-full flex">
                                            <Icon :name="item.icon_name"
                                                class="w-5 h-5 mr-3 inline fill-slate-500 group-hover:fill-turquesa" />
                                            <span class="capitalize group-hover:text-turquesa"> {{ item.name }}</span>
                                            <Icon :name="item.toggle_submenu ? 'up' : 'down'"
                                                class="w-5 h-5 inline ml-auto fill-slate-500 group-hover:fill-turquesa" />
                                        </button>
                                        <Link class="group" v-else :href="item.href">
                                        <Icon :name="item.icon_name"
                                            class="w-5 h-5 mr-3 inline fill-slate-500 group-hover:fill-turquesa"
                                            :class="{ 'fill-turquesa ': $page.url.startsWith(item.href) }" />
                                        <span class="capitalize group-hover:text-turquesa"
                                            :class="{ 'text-turquesa font-bold': $page.url.startsWith(item.href) }">
                                            {{ item.name }}</span>
                                        </Link>
                                        <transition name="submenu-slice">
                                            <ul v-if="item.submenu.length && item.toggle_submenu"
                                                class="pl-8 pt-1 overflow-hidden">
                                                <template v-for="subitem in item.submenu" :key="subitem.name">
                                                    <li v-if="hasPermission(subitem.permiso)" class="py-1 pl-3 border-l-2"
                                                        :class="{ 'bg-fondColor border-l-turquesa': $page.url.startsWith(subitem.href) }">
                                                        <Link :href="subitem.href" class="md:text-sm">
                                                        <span class="capitalize hover:text-turquesa"
                                                            :class="{ 'text-turquesa font-bold': $page.url.startsWith(subitem.href) }">{{
                                                                subitem.name }}</span>
                                                        </Link>
                                                    </li>
                                                </template>
                                            </ul>
                                        </transition>
                                    </li>
                                </template>
                            </ul>
                            <div class="py-4 px-3 border-t relative md:text-center">
                                <button class="px-4 py-2 bg-turquesa rounded-lg"
                                    @click="showUserDropdown = !showUserDropdown">
                                    <span class="text-white">{{ $page.props.user.username }}</span>
                                    <icon class="ml-1 w-5 h-5 inline fill-white" name="cheveron-down" />
                                </button>
                                <div class="absolute z-100 bg-white mt-1 rounded-lg w-44 border shadow-lg md:top-[-120%] md:left-6"
                                    v-if="showUserDropdown">
                                    <Link class="block px-6 py-2 text-left hover:text-white hover:bg-turquesa"
                                        :href="route('profile.show')">
                                    Mi Perfil
                                    </Link>
                                    <form @submit.prevent="logout" method="POST">
                                        <Link class="block px-6 py-2 w-full text-left hover:text-white hover:bg-turquesa"
                                            href="/logout" method="POST" as="button">Logout</Link>
                                    </form>
                                </div>
                            </div>
                        </nav>
                    </transition>
                </NavigationMenu>
                <div class="px-5 py-3 bg-fondColor md:px-8 md:py-8 md:flex-1 md:h-screen md:overflow-y-auto" scroll-region>
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
/* DROPDOWN TRANSITIONS */
.slice-enter-from {
    transform: translateY(-100%);
}

.slice-enter-to {
    transform: translateY(0);
}

.slice-enter-active,
.slice-leave-active {
    transition: all 350ms ease;
}

.slice-leave-from {
    transform: translateY(0);
}

.slice-leave-to {
    transform: translateY(-100%);
}

@media(min-width: 768px) {

    .slice-enter-active,
    .slice-leave-active {
        transition: none;
    }

}

/* SUBMENU TRANSITION */
.submenu-slice-enter-from {
    max-height: 0px;

}

.submenu-slice-enter-to {
    max-height: 500px;

}

.submenu-slice-enter-active,
.submenu-slice-leave-active {
    transition: all 350ms ease;
}

.submenu-slice-leave-from {
    max-height: 500px;
}

.submenu-slice-leave-to {
    max-height: 0px;
}
</style>