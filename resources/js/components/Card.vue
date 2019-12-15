<template>
    <div class="card">
        <div class="card-header">
            {{ carddata.cardheader }}
        </div>
        <div class="card-block">
            <h4 class="card-title">{{ carddata.cardtitle }}</h4>
        </div>
        <div class="card-footer">
            {{ carddata.cardfooter }}
        </div>
    </div>
</template>


<script >
    export default {
        props: ['carddata'],

    }
</script>
