<template>
  <button class="Button" :disabled="loading">
      <svg v-if="loading" class="Button__Icon Button__Spinner" viewBox="...">
          <path d="..."/>
      </svg>
      <svg v-else class="Button__Icon" viewBox="0 0 20 20">
          <path d="..."/>
      </svg>
      <span v-if="!loading" class="Button__Content">
          <slot></slot>
      </span>
  </button>
</template>

<script>
export default {
    props: {
        loading: { type: Boolean }
    }
}
</script>
