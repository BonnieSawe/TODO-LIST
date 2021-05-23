<template>
<DashWrap>
    <b-card class="col-lg-7 col-xl-7 flex-row mx-auto px-0">
        <b-tabs card align="center">
            
            <DayTab></DayTab>
            
            <WeekTab></WeekTab>
        </b-tabs>
    </b-card>
</DashWrap>
</template>

<script>

import store from '@/store'

export default ({
    name: "HOME",
    data() {
        return {
            isAuthenticated: false,
        }
    },

    methods: {
        checkAuth(){
            var isAuthenticated = store.getters["auth/check"];
            console.log(isAuthenticated);
        },
    }
})
</script>

