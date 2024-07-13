<template>
  <div class="main-container">
    <div class="rectangle">
      <div class="rectangle-1"><span class="daftar">Daftar</span></div>
      <div class="rectangle-2"><span class="masuk">Masuk</span></div>
      <div class="group"></div>
      <span class="karir-gemilang">Karir Gemilang</span>
      <span class="home">Home</span>
      <span class="about">About</span>
      <span class="jobs">Jobs</span>
      <span class="contact-us">Contact Us</span>
    </div>
    <div class="texture">
      <div class="background">
        <div class="vector"></div>
      </div>
      <div class="objects">
        <div class="group-3">
          <div class="clip-path-group"></div>
        </div>
      </div>
    </div>
    <div class="image"></div>
    <span class="browse-apply-prepare">
      Browse. Apply.<br />Prepare Your Future
    </span>
    <span class="text-9">
      Cari pekerjaan impian dengan cepat dan mudah bersama Karir
      Gemilang!
    </span>
    <div class="wrapper-3">
      <span class="text-a">Cari kerja sekarang!</span>
    </div>
  </div>
</template>

<script setup>
  // JavaScript code can be added here if needed
</script>

<style scoped>
  :root {
    --default-font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
      Ubuntu, "Helvetica Neue", Helvetica, Arial, "PingFang SC",
      "Hiragino Sans GB", "Microsoft Yahei UI", "Microsoft Yahei",
      "Source Han Sans CN", sans-serif;
  }

  .main-container {
    overflow: hidden;
  }

  .main-container,
  .main-container * {
    box-sizing: border-box;
  }

  input,
  select,
  textarea,
  button {
    outline: 0;
  }

  .main-container {
    position: relative;
    width: 1440px;
    height: 1024px;
    margin: 0 auto;
    background: #ffffff;
    overflow: hidden;
  }
  .rectangle {
    position: relative;
    width: 1440px;
    height: 87px;
    margin: 0 0 0 0;
    background: #ffffff;
    border: 1px solid #e1e1e1;
    z-index: 10;
  }
  .rectangle-1 {
    position: absolute;
    width: 86px;
    height: 35px;
    top: 25px;
    left: 1276px;
    background: #ffe667;
    z-index: 12;
    border-radius: 5px;
  }
  .daftar {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    position: absolute;
    width: 56px;
    height: 18px;
    top: 8px;
    left: 15px;
    color: #000000;
    font-family: Poppins, var(--default-font-family);
    font-size: 12px;
    font-weight: 400;
    line-height: 18px;
    text-align: center;
    white-space: nowrap;
    z-index: 13;
  }
  .rectangle-2 {
    position: absolute;
    width: 86px;
    height: 35px;
    top: 25px;
    left: 1160px;
    border: 1px solid #ffe667;
    z-index: 15;
    border-radius: 5px;
  }
  .masuk {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    position: absolute;
    width: 56px;
    height: 18px;
    top: 7px;
    left: 14px;
    color: #000000;
    font-family: Poppins, var(--default-font-family);
    font-size: 12px;
    font-weight: 400;
    line-height: 18px;
    text-align: center;
    white-space: nowrap;
    z-index: 16;
  }
  .group {
    position: absolute;
    width: 31.762px;
    height: 31.762px;
    top: 27px;
    left: 76px;
    background: url(../assets/karirlogo.png)
      no-repeat center;
    background-size: cover;
    z-index: 23;
  }
  .karir-gemilang {
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    position: absolute;
    height: 25px;
    top: 30px;
    left: calc(50% - 602px);
    color: #000000;
    font-family: Poppins, var(--default-font-family);
    font-size: 16px;
    font-weight: 600;
    line-height: 24px;
    text-align: left;
    white-space: nowrap;
    z-index: 22;
  }
  .home {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    position: absolute;
    width: 78px;
    height: 18px;
    top: 33px;
    left: 816px;
    color: #000000;
    font-family: Poppins, var(--default-font-family);
    font-size: 12px;
    font-weight: 400;
    line-height: 18px;
    text-align: center;
    white-space: nowrap;
    z-index: 17;
  }
  .about {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    position: absolute;
    width: 78px;
    height: 18px;
    top: 33px;
    left: 894px;
    color: #000000;
    font-family: Poppins, var(--default-font-family);
    font-size: 12px;
    font-weight: 400;
    line-height: 18px;
    text-align: center;
    white-space: nowrap;
    z-index: 18;
  }
  .jobs {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    position: absolute;
    width: 78px;
    height: 18px;
    top: 33px;
    left: 972px;
    color: #000000;
    font-family: Poppins, var(--default-font-family);
    font-size: 12px;
    font-weight: 400;
    line-height: 18px;
    text-align: center;
    white-space: nowrap;
    z-index: 19;
  }
  .contact-us {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    position: absolute;
    width: 78px;
    height: 18px;
    top: 33px;
    left: 1050px;
    color: #000000;
    font-family: Poppins, var(--default-font-family);
    font-size: 12px;
    font-weight: 400;
    line-height: 18px;
    text-align: center;
    white-space: nowrap;
    z-index: 20;
  }
  .texture {
    position: absolute;
    width: 1440px;
    height: 1024px;
    top: 0;
    left: 0;
    opacity: 0.75;
    overflow: hidden;
  }
  .background {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1;
  }
  .vector {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: url(../assets/karirgemilang-logo.svg)
      no-repeat center;
    background-size: 100% 100%;
    z-index: 2;
  }
  .objects {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 3;
  }
  .group-3 {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 4;
  }
  .clip-path-group {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-size: 100% 100%;
    z-index: 5;
  }
  .image {
    position: absolute;
    width: 623.897px;
    height: 606.897px;
    top: 112px;
    left: 37px;
    background-size: cover;
    z-index: 30;
  }
  .browse-apply-prepare {
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    position: absolute;
    width: 470px;
    height: 120px;
    top: 264px;
    left: 850px;
    color: #ffffff;
    font-family: Poppins, var(--default-font-family);
    font-size: 45px;
    font-weight: 700;
    line-height: 60px;
    text-align: left;
    z-index: 28;
  }
  .text-9 {
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    position: absolute;
    width: 352px;
    height: 59px;
    top: 77px;
    left: 647px;
    color: #ffffff;
    font-family: Poppins, var(--default-font-family);
    font-size: 18px;
    font-weight: 400;
    line-height: 28px;
    text-align: left;
    z-index: 29;
  }
  .wrapper-3 {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    position: absolute;
    width: 257px;
    height: 50px;
    top: 486px;
    left: 850px;
    background: #ffe667;
    border-radius: 5px;
    z-index: 27;
  }
  .text-a {
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    position: absolute;
    height: 21px;
    top: 15px;
    left: 56px;
    color: #000000;
    font-family: Poppins, var(--default-font-family);
    font-size: 18px;
    font-weight: 600;
    line-height: 21px;
    text-align: left;
    white-space: nowrap;
    z-index: 28;
  }
</style>
