<template>
  <div class="header">
    <div>
      <h1>Product Add</h1>
    </div>
    <div class="separator"></div>
    <div>
      <button class="vertical-center" @click="submit()">Save</button>
      <button id="delete-product-button" class="vertical-center" style="margin-left: 10px;"><NuxtLink to="/">Cancel</NuxtLink></button>
    </div>
  </div>
  <div style="padding: 10px;">
    <form id="product_form">
      <div class="form-field">
        <label for="sku">SKU </label>
        <input id="sku" type="text" v-model="form.sku" :class="{ error: msg.sku !== '' }" @change="validate('sku')" autofocus required />
        <span v-if="msg.sku" class="text-error">{{msg.sku}}</span>
      </div>
      <div class="form-field">
        <label for="name">Name </label>
        <input id="name" type="text" v-model="form.name" :class="{ error: msg.name !== '' }"  @change="validate('name')" required />
        <span v-if="msg.name" class="text-error">{{msg.name}}</span>
      </div>
      <div class="form-field">
        <label for="price">Price ($) </label>
        <input id="price" type="number" min="0.00" step="0.01" v-model="form.price" :class="{ error: msg.price !== '' }"  @change="validate('price')" required />
        <span v-if="msg.price" class="text-error">{{msg.price}}</span>
      </div>
      <div class="form-field">
        <label for="type">Type </label>
        <select name="type" id="productType" v-model="form.type" :class="{ error: msg.type !== '' }" @change="validate('type')" required>
          <option value="dvd" selected="selected">DVD</option>
          <option value="furniture">Furniture</option>
          <option value="book">Book</option>
        </select>
        <span v-if="msg.type" class="text-error">{{msg.type}}</span>
        <div v-if="form.type === ''" style="padding-bottom: 10px;"></div>
      </div>
      <div class="form-field" id="dvd" v-if="form.type == 'dvd'">
        <label for="size">Size (MB) </label>
        <input id="size" type="number" min="0.00" max="1000000.00" step="0.01" v-model="form.size" :class="{ error: msg.size !== '' }" @change="validate('size')" required />
        <span v-if="msg.size" class="text-error">{{msg.size}}</span>
        <p v-if="form.size === ''"><small>Please, provide size</small></p>
        <div style="padding-bottom: 10px;"></div>
      </div>
      <div class="form-field" id="furniture" v-if="form.type == 'furniture'">
        <div>
          <label for="height">Height (CM) </label>
          <input id="height" type="number" min="0.00" max="1000000.00" step="0.01" v-model="form.height" :class="{ error: msg.height !== '' }" @change="validate('height')" required />
          <span v-if="msg.height" class="text-error">{{msg.height}}</span>
        </div>
        <div class="form-field">
          <label for="width">Width (CM) </label>
          <input id="width" type="number" min="0.00" max="1000000.00" step="0.01" v-model="form.width" :class="{ error: msg.width !== '' }" @change="validate('width')" required />
          <span v-if="msg.width" class="text-error">{{msg.width}}</span>
        </div>
        <div class="form-field">
          <label for="length">Length (CM) </label>
          <input id="length" type="number" min="0.00" max="1000000.00" step="0.01" v-model="form.length" :class="{ error: msg.length !== '' }" @change="validate('length')" required />
          <span v-if="msg.length" class="text-error">{{msg.length}}</span>
        </div>
        <p v-if="form.length === '' || form.width === '' || form.height === ''"><small>Please, provide dimensions</small></p>
        <div style="padding-bottom: 10px;"></div>
      </div>
      <div class="form-field" id="book" v-if="form.type == 'book'">
        <label for="weight">Weight (KG) </label>
        <input id="weight" type="number" min="0.00" max="1000000.00" step="0.01" v-model="form.weight" :class="{ error: msg.weight !== '' }" @change="validate('weight')" required />
        <span v-if="msg.weight" class="text-error">{{msg.weight}}</span>
        <p v-if="form.weight === ''"><small>Please, provide weight</small></p>
        <div style="padding-bottom: 10px;"></div>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

import requestData from '../functions/common.js';

const submitted = ref(false);
const form = ref({sku: '', name: '', price: '', type: '', size: '', height: '', width: '', length: '', weight: ''});
const msg = ref({sku: '', name: '', price: '', type: '', size: '', height: '', width: '', length: '', weight: ''});

const validate = (element?: string): number => {
    console.log(element);

    let i = 0;

    for (const property in form.value) {
        if (typeof element === "undefined" || property === element) {
            if (form.value[property] === '') {
                if (form.value['type'] !== 'dvd' && form.value['type'] !== 'furniture' && form.value['type'] !== 'book' ||
                    form.value['type'] === 'dvd' && (property !== 'weight' && property !== 'height' && property !== 'width' && property !== 'length') ||
                    form.value['type'] === 'book' && (property !== 'size' && property !== 'height' && property !== 'width' && property !== 'length') ||
                    form.value['type'] === 'furniture' && (property !== 'size' && property !== 'weight')) {

                    msg.value[property] = `Please, submit required ${property}!`;

                    ++i;
                }
            }

            if (form.value['type'] !== 'dvd' && form.value['type'] !== 'furniture' && form.value['type'] !== 'book' ||
                form.value['type'] === 'dvd' && (property !== 'weight' && property !== 'height' && property !== 'width' && property !== 'length') ||
                form.value['type'] === 'book' && (property !== 'size' && property !== 'height' && property !== 'width' && property !== 'length') ||
                form.value['type'] === 'furniture' && (property !== 'size' && property !== 'weight')) {

                if ((property === 'price' || property === 'size' || property === 'height' || property === 'width' || property === 'lenght' || property === 'weight') && msg.value[property] === '' && !form.value[property].toString().match(/^[0-9]+\.{0,1}[0-9]{0,2}$/)) {
                    msg.value[property] = `Please, provide the data of type ${property}!`;

                    ++i;
                }
            }
        }
    }

    return i;
}

const submit = async () => {
    submitted.value = true;

    console.log(form.value);

    let i = 0;

    i = validate();

    if (!i) {
        submitted.value = false;

        console.log(form.value);

        requestData("http://localhost:8000", "POST", form.value).then(data => {
            console.log(data);
        });

        for (const property in form.value) {
            form.value[property] = '';
        }

        console.log('Form submitted.');

        await navigateTo({ path: '/' });
    }
}
</script>

<style scoped>
button {
  cursor: pointer;
}

input {
  height: 30px;
  width: 40%;
}

select {
  height: 35px;
}

label {
  width: 100px;
  text-align: left;
  font-weight: bold;
  display: inline-block;
}

span {
  margin-left: 5px;
}

a {
  text-decoration: none;
  color: #000;
}

p {
  margin-top: 0px;
  margin-bottom: 0px;
  margin-left: 100px;
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

.form-field {
  padding: 10px 0px 0px 0px;
}

.error {
  border: 1px solid red;
}

.text-error {
    color: red;
}
</style>