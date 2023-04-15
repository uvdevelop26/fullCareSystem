<script>

export default {
    
}

</script>
<template>
    <div class="p-3 mb-3 flex items-center w-full max-w-md gap-4 rounded-lg shadow-lg bg-white">
        <div class="h-full">
            <slot name="icon-header" />
        </div>
        <div class="">
            <slot />
        </div>
    </div>
</template>
