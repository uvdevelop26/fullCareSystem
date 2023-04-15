<template>
    <div class="grid md:grid-cols-2 border shadow-xl rounded-lg overflow-hidden bg-white">
        <div class="md:mr-ml-9 p-5">
            <div class="pb-3">
                <slot name="logo" />
            </div>
            <div class="py-3">
                <slot name="image" />
            </div>
        </div>
        <div class="p-5 rounded-t-3xl md:rounded-l-3xl md:rounded-r-none bg-fondColor">
            <div>
                <slot name="welcome" />
            </div>
            <slot />
        </div>
    </div>
</template>