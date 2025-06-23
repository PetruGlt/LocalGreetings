<!DOCTYPE html>
<html lang="en" prefix="scholarly: http://purl.org/scholarly/">
<head>
    <meta charset="UTF-8">
    <title>Functional Specifications – SportIS</title>
    <link rel="stylesheet" href="https://w3c.github.io/scholarly-html/css/scholarly.min.css">
</head>
<body>
  <article>
    <header>
        <h1>SportIS</h1>    
        <h3>A web platform designed for organizing local sports events and building social connections between users.</h3>
    </section>

    <section>
      <h2>📌 1. Introduction</h2>
      <p><strong>SportIS</strong> allows users to discover, create, and join local sports events. In addition to event participation, users can form friendships with others through a mutual request system. The platform aims to promote community engagement and simplify local event coordination.</p>
    </section>

    <section>
      <h2>⚙️ 2. Essential Functionalities</h2>
      <ul>
        <li><strong>🔐 Authentication:</strong> Users can register and log in securely using their credentials.</li>
        <li><strong>📅 Event Management:</strong> Users can create events, define max participants, set start/end time, and associate tags.</li>
        <li><strong>🔍 Event Filtering:</strong> Events can be filtered by name, date range, tags, and participant limits.</li>
        <li><strong>👥 Event Participation:</strong> Users can view and join available events with real-time capacity checks.</li>
        <li><strong>🤝 Friendship System:</strong> Users can send and accept friend requests and view the number of days since the friendship began.</li>
        <li><strong>🙋 User Profile:</strong> Each user has a public profile showing their events and social connections.</li>
      </ul>
    </section>

    <section>
      <h2>🧑‍💻 3. User Interaction</h2>
      <p>The platform provides a modern and responsive interface. Users interact with:</p>
      <ul>
        <li>✔️ Clean navigation menus</li>
        <li>✔️ Modal forms for adding events</li>
        <li>✔️ Multi-select inputs for tags</li>
        <li>✔️ Filterable event listings</li>
        <li>✔️ Profile pages with real-time data</li>
      </ul>
      <p>The overall experience is optimized for ease of use, even on mobile devices.</p>
    </section>

    <section>
      <h2>💾 4. Technical Requirements</h2>
      <ul>
        <li><strong>Backend:</strong> PHP 8+, MySQL</li>
        <li><strong>Frontend:</strong> HTML5, CSS3, JavaScript (modular)</li>
        <li><strong>Architecture:</strong> MVC (Model-View-Controller)</li>
        <li><strong>Deployment:</strong> Local (XAMPP) or Cloud-based server (Apache)</li>
      </ul>
    </section>

    <section>
      <h2>📊 5. Assumptions and Constraints</h2>
      <ul>
        <li>🕒 Events must not exceed 6 hours in duration.</li>
        <li>👤 Only authenticated users can create or join events.</li>
        <li>📱 UI assumes modern browser compatibility (Chrome, Firefox, Edge).</li>
        <li>🛠️ Tag management is pre-defined or dynamically created when missing.</li>
      </ul>
    </section>

    <section>
      <h2>✅ 6. Conclusion</h2>
      <p><strong>SportIS</strong> successfully meets its goal of enhancing local community sports engagement through a well-structured and user-friendly web application. 
      It provides all the necessary features to organize events and foster social connections efficiently.</p>
    </section>
  </article>

</body>
</html>
