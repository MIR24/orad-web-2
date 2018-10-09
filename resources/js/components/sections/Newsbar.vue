<template>
    <div class="content n-bar">
        <div class="content-loader" v-if="loading">
            <div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>
        </div>
        <div v-else class="m-form m-form--fit m-form--label-align-right">
            <div class="m-portlet__body">
                <div class="entity-block newsbar">
                    <div class="form-group m-form__group">
                        <label for="exampleTextarea">Топы</label>
                        <textarea v-model="records.tops"  placeholder="Топы" class="form-control m-input" id="exampleTextarea" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="entity-block newsbar">
                    <div class="form-group m-form__group">
                        <label for="exampleTextarea">Бегущая строка</label>
                        <textarea v-model="records.ticker"  placeholder="Бегущая строка" class="form-control m-input" id="exampleTextarea" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <button v-on:click="submit" class="btn btn-success btn-submit">Сохранить</button>
        </div>

    </div>
</template>

<script>
    const records = {
        tops: "sdfgjklsdjfglkdjsgjsdkjfglg\nsdfjghjsdhfgkjsdhflkgsdhfgldjkshg\nsidfjgksdhfgkhjlsdhglkds\nsfjhgsjdkhgkjsdhlkjghsldkjhg",
        ticker: "sdfgjklsdjfglkdjsgjsdkjfglg\nsdfjghjsdhfgkjsdhflkgsdhfgldjkshg\nsidfjgksdhfgkhjlsdhglkds\nsfjhgsjdkhgkjsdhlkjghsldkjhg",
    };
    export default {
        data() {
            return {
                records: {
                    tops: '',
                    ticker: '',
                },
                loading: true,
            };
        },
        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                setTimeout(() => {
                    this.records = Object.assign({}, records);
                    this.loading = false;
                }, 500);
            },
            submit() {
                console.log(this.records);
            }
        }
    }
</script>
