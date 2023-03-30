<template>
    <div class="grid md:grid-cols-2 p-6 border shadow-lg rounded-lg bg-white">
        <div class="md:mr-ml-9">
            <div class="py-3">
                <slot name="logo" />
            </div>
            <div class="py-3">
                <slot name="image" />
            </div>
        </div>
        <div class="md:ml-9">
            <div>
                <slot name="welcome" />
            </div>
            <slot />
        </div>
    </div>
</template>