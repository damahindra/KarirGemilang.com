<template>
    <div class="background position-fixed">
      <img src="@/assets/Vector.png" alt="background Image"> 
    </div>
</template>

<script>

export default {

}
</script>

<style scoped>

.background {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: -1;
}

.background img {
width: 100%;
height: 100%;
opacity: 45%;
}

@keyframes fadeIn {
from {
  opacity: 0;
  transform: translateX(-50px);
}
to {
  opacity: 1;
  transform: translateX(0);
}
}

.fade-in {
animation: fadeIn 1s ease-in-out;
}
</style>
