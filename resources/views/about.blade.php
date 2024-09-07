<x-layout>

  <div class="container py-md-5 container--narrow">
    <div class="d-flex justify-content-between">
      <h2>About Us</h2>
      
      <span class="pt-2">
        
        
      </span>
    </div>

    

    <div class="body-content">
      <p>Welcome to Universal Task Tracking System! We are a team of dedicated professionals committed to simplifying your task management experience.</p>
      <p>Our journey began with a vision to streamline task tracking and project management for individuals and businesses alike. We understand the challenges of staying organized and productive in a fast-paced world, and we are here to help you overcome them.</p>
      
      <form action="/goHome" method="POST" class="d-inline">
        @csrf 
        <button class="btn btn-sm btn-secondary">Go Home</button>
    </form>
    </div>
  </div>

</x-layout>
