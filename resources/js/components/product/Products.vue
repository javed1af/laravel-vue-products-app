<template>
    <div>
        <br/><h4><b>Products</b></h4>
        <hr>
        <div class="col-md-12">
            
            <form @submit.prevent="getResults" enctype="multipart/form-data">

                <div class="input-group">
                    <input type="text" class="form-control" v-model="search_by_product_name" placeholder="Search by Product Name">
                    <input type="text" class="form-control" v-model="search_by_author_name" placeholder="Search by Author Name">
                    <input type="text" class="form-control" v-model="search_by_date" placeholder="Search by Date Created (YYYY-MM-DD)">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </div>

            </form>
        </div>
        <br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Author Name</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products.data" :key="product.id">
                <td>{{ product.id }}</td>
                <td>{{ product.product_name }}</td>
                <td>{{ product.author_name }}</td>
                <td>{{ product.created_at }}</td>
                <td>{{ product.updated_at }}</td>
            </tr>
            </tbody>
        </table>
        <Pagination :data="products" @pagination-change-page="getResults" />
    </div>
</template>

<script>
import Pagination from 'laravel-vue-pagination';

export default {
    components: {
        'Pagination': Pagination
    },

    data() {
        return {
            products: {},
            search_by_product_name: '',
            search_by_author_name: '',
            search_by_date: '',
        }
    },

    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/products')
                .then(response => {
                    this.products = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },

    methods: {
        getResults(page = 1) {

            let search_by_product_name = this.search_by_product_name;
            let search_by_author_name = this.search_by_author_name;
            let search_by_date = this.search_by_date;

            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/products?page=' +page+'&search_by_product_name='+search_by_product_name+'&search_by_author_name='+search_by_author_name+'&search_by_date='+search_by_date).then(response => {
                    this.products = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
            })
        },
    },

    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
