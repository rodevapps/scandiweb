<template>
  <div class="header">
    <div>
      <h1>Product List</h1>
    </div>
    <div class="separator"></div>
    <div>
      <button class="vertical-center"><NuxtLink to="/add-product">ADD</NuxtLink></button>
      <button id="delete-product-button" class="vertical-center" style="margin-left: 10px;" @click="massDelete()">MASS DELETE</button>
    </div>
  </div>
  <p class="text-center" v-if="isLoading">Loading products...</p>
  <div class="grid-container">
    <div class="grid-item" v-for="p in products" :key="p.id">
      <input type="checkbox" :value="p.id" class="delete-checkbox" v-model="checkedProducts" />
      <p class="text-center">{{ p.sku }}</p>
      <p class="text-center"><strong>{{ p.title }}</strong></p>
      <p class="text-center"><strong>{{ p.price }}</strong>$</p>
      <p class="text-center" v-if="p.size !== null" >Size: <strong>{{ p.size }}MB</strong></p>
      <p class="text-center" v-if="p.weight !== null" >Weight: <strong>{{ p.weight }}KG</strong></p>
      <p class="text-center" v-if="p.height !== null && p.width !== null && p.length !== null" >Dimension: <strong>{{ p.height }}x{{ p.width }}x{{ p.length }}cm</strong></p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';

import requestData from '../functions/common.js';

const isLoading = ref(true);
const products = ref([]);
const checkedProducts = ref([]);

const massDelete = () => {
    console.log(checkedProducts.value);

    requestData("http://localhost:8000", "DELETE", checkedProducts.value).then(data => {
        console.log(JSON.parse(data));

        if (JSON.parse(data).status === "success") {
            const currentProducts = products.value.filter(i => !checkedProducts.value.includes(i.id));
            console.log(currentProducts);
            products.value = currentProducts;
        }
    });
}

onMounted(() => {
    fetch('http://localhost:8000').then(response => response.json()).then(data => {
        console.log(data);
        products.value = data;
        isLoading.value = false
    });
})
</script>

<style scoped>
button {
  cursor: pointer;
}

a {
    text-decoration: none;
    color: #000;
}

.header {
  width: 100%;
  display: flex;
  border-bottom: 1px solid #000;
}

.separator {
  flex-grow: 1;
}

.vertical-center {
  position: relative;
  top: 40%;
}

.text-center {
    text-align: center;
}

.grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto;
}

.grid-item {
  border: 1px solid #000;
  padding: 10px;
  margin: 10px;
  width: 150px;
}
</style>