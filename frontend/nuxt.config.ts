// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  publicRuntimeConfig: {
    BACKEND_URL: process.env.BACKEND_URL
  },
})
