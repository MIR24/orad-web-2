<template>
    <div class="content">
        <div class="content-loader" v-if="loading">
            <div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>
        </div>
        <div v-else class="m-form m-form--fit m-form--label-align-right">
            <div class="m-portlet__body">
                <div class="entity-block">
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Заголовок</label>
                        <input type="text" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Заголовок">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleTextarea">Текст</label>
                        <textarea placeholder="Текст" class="form-control m-input" id="exampleTextarea" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <button v-on:click="shout(7)" class="btn btn-primary">+ Добавить топ</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                records: [],
                loading: true,
            };
        },
        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                setTimeout(()=>{
                    this.loading = false;
                }, 2000);
            },
            shout(num) {
                alert(num);
            },
        }
    }
</script>
