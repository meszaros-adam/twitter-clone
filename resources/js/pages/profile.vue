<template>
    <div>
        {{ route.params.id }}
    </div>
</template>

<script>
import { useRoute } from 'vue-router'
export default {
    setup() {
        const route = useRoute()

        return { route }
    }
}
</script>