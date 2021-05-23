<template>
    <div class="mb-3 row d-flex">

        <div class="float-left pr-2 invisible">
            <i class="fa fa-thumb-tack pinned"></i>
        </div>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="cb3" name="">
            <label class="custom-control-label" for="cb3">Finish Visual Design</label>
            <br>
            <span class="">One of my  goals in 2017</span>
        </div>

        <div class="ml-auto pl-5">
            <Actions></Actions>
        </div>
    </div>
</template>
<script>

export default {
    name: 'SingleTask',
    props: {},
}
</script>
