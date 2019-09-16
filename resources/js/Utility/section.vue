<template>
    <div>
        <select class="form-control">
            <optgroup label="This is a group">
                <option value="12" selected>This is item 1</option>
                <option value="13">This is item 2</option>
                <option value="14">This is item 3</option>
            </optgroup>
        </select>
    </div>

</template>

<script>
    export default {
        name: "section",
        data() {
        },
        computed: {
            sections() {
                return this.$store.state.sections;
            }
        }
    }
</script>
