<template>
    <div class="mt-5 pt-3 form-input">
        <span class="pt-3"><i class="fa fa-list" aria-hidden="true"></i></span>
        <b-form-input
        :state="null"
        placeholder="Add a task..."
        class="form-control"
        type="text"
        required
        />
    </div>
</template>
<script>

export default {
    name: 'AddTask',
    props: {},
}
</script>
