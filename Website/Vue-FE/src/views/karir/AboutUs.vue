<template>
    <div>
      <NavbarComponent />
      <BackgroundComponent />
      <div class="about-page">
        <div class="content">
          <h1>About Us</h1>
          <p>
            Welcome to our company! Our journey started with a vision to revolutionize the industry. Over the years, we have achieved remarkable milestones and continue to strive for excellence. Our team is dedicated, passionate, and always ready to tackle new challenges.
          </p>
          <h2>Our Journey</h2>
          <p>
            From our humble beginnings, we have grown into a leading name in the market. Our success is attributed to our innovative approach and unwavering commitment to quality. We believe in nurturing talent and fostering a culture of continuous learning and development.
          </p>
          <h2>Career Opportunities</h2>
          <p>
            We are always on the lookout for talented individuals who share our vision and values. If you are passionate about making a difference and want to be part of a dynamic team, explore our career opportunities and join us in our journey towards excellence.
          </p>
          <h2>Our Values</h2>
          <p>
            Integrity, innovation, and inclusivity are at the core of everything we do. We believe in creating a work environment that is diverse, equitable, and supportive. Our values guide our actions and decisions, ensuring we remain true to our mission and vision.
          </p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import NavbarComponent from '@/components/NavbarComponent.vue';
  import BackgroundComponent from '@/components/BackgroundComponent.vue';
  
  export default {
    components: {
      NavbarComponent,
      BackgroundComponent
    }
  }
  </script>
  
  <style scoped>
  .about-page {
    display: flex;
    justify-content: center;
    padding: 20px;
  }
  
  .content {
    max-width: 800px;
    width: 100%;
    background: rgba(255, 255, 255, 0.9);
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
  }
  
  h2 {
    font-size: 2em;
    margin-top: 30px;
    margin-bottom: 15px;
  }
  
  p {
    font-size: 1.1em;
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
  }
  </style>
  