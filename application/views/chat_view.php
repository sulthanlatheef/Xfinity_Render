<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Xyle – Automobile Chat Assistant</title>

  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <!-- Lottie web component -->
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

  <style>
    :root {
      --primary: #ff6b00;
      --primary-dark: #e65c00;
      --primary-light: #fff1e0;
      --bg: #fffaf3;
      --white: #ffffff;
      --text: #2d2d2d;
      --radius: 12px;
      --transition: 0.3s ease;
      --shadow: rgba(0,0,0,0.1);
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body, html { height: 100%; font-family: 'Segoe UI', sans-serif; background: var(--bg); }

    /* — Layout Container — */
    #chat {
      display: flex;
      flex-direction: column;
      height: 100vh;
      width: 100vw;
    }

    /* — Header with Lottie — */
    header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      padding: 0.5rem 2rem;
      box-shadow: 0 4px 12px var(--shadow);
    }
    .header-left,
    .header-center,
    .header-right {
      display: flex;
      align-items: center;
    }
    .header-left lottie-player {
      width: 60px;
      height: 60px;
      margin-right: 0.75rem;
    }
    .header-center {
      flex: 1;
      justify-content: center;
      font-size: 1.8rem;
      font-weight: 700;
      color: #fff;
    }
    .header-center span {
      color: #fff7f2;
      margin-left: 0.25rem;
    }
    .header-right {
      font-size: 1rem;
      font-weight:bold;
      color: rgb(255, 255, 255);
      gap: 0.5rem;
    }
    .header-right i {
      animation: sway 4s infinite ease-in-out;
    }
    @keyframes sway {
      0%,100% { transform: rotate(0deg); }
      50%     { transform: rotate(8deg); }
    }

    /* — Messages Area — */
    #messages {
      flex: 1;
      overflow-y: auto;
      padding: 2rem 3vw;
      scroll-behavior: smooth;
    }
    .message {
      position: relative;
      clear: both;
      max-width: 75%;
      padding: 1rem 1.25rem;
      margin: 1.5rem 0;
      border-radius: var(--radius);
      line-height: 1.5;
      word-break: break-word;
      animation: fadeInUp 0.4s ease both;
      box-shadow: 0 2px 6px var(--shadow);
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(10px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* — Bot Messages — */
    .message.bot {
      background: var(--white);
      border-left: 4px solid var(--primary);
      margin-right: auto;
      color: var(--text);
    }
    .message.bot h3 {
      margin-bottom: 0.5rem;
      color: var(--primary);
      font-size: 1.1rem;
    }

    /* — User Messages — */
    .message.user {
      background: var(--primary);
      color: #fff;
      float: right;
      margin-left: auto;
      border-radius:20px;
      font-size:16px;
      padding-top:.8rem;
      
    }
    .message.user::after {
      content: '';
      position: absolute;
      right: -8px; top: 50%;
      transform: translateY(-50%);
      border: 8px solid transparent;
      border-left-color: var(--primary);
    }

    /* — Typing Indicator — */
    #typing-container {
      display: none;
      text-align: center;
      padding: 1.5rem 0;
    }
    .typing {
      display: inline-flex;
      align-items: flex-end;
      gap: 8px;
    }
    .typing-dot {
      width: 12px;
      height: 12px;
      background: var(--primary);
      border-radius: 50%;
      animation: bounce 0.6s infinite alternate;
    }
    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }
    @keyframes bounce {
      to { transform: translateY(-15px); }
    }

    /* — Input Area — */
    #input-area {
      display: flex;
      align-items: center;
      padding: 1rem 2vw;
      background:rgb(251, 216, 198);
      border-radius:0px;
      border-top: 1px solid var(--primary-light);
      gap: 0.75rem;
    }
    #userInput {
      flex: 1;
      padding: 0.85rem 1rem;
      border-radius: var(--radius);
      border: 1px solid #ccc;
      font-size: 1.1rem;
      transition: border-color var(--transition);
    }
    #userInput:focus {
      border: 1px solid var(--primary);
      outline: none;
    }
    button {
      border: none;
      border-radius: var(--radius);
      padding: 0.75rem 1.2rem;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background var(--transition);
      display: flex;
      align-items: center;
      gap: 6px;
      transition:all .5s ease;
    }
    #sendBtn {
      background:rgb(255, 81, 0);
      border-radius:30px;
      color: #fff;
    }
    #sendBtn:hover {
      transform:scale(1.05);
    }
    #reset {
      background:rgb(255, 0, 0);
      color: #fff;
      transition:all .5s ease;
      border-radius:50px;
    }
    #reset:hover {
      transform:scale(1.05);
    }
    @keyframes ghostFloat {
  0% {
    transform: translateY(0px);
    opacity: 1;
  }
  25% {
    transform: translateY(-5px);
    opacity: 1;
  }
  50% {
    transform: translateY(0px);
    opacity: 1;
  }
  75% {
    transform: translateY(5px);
    opacity: 1;
  }
  100% {
    transform: translateY(0px);
    opacity: 1;
  }

}
.ghost-icon {
  font-size: 28px;
  color: var(--primary);
 
  padding-top: 6px;
}

.user-icon {
  font-size: 26px;
  color: var(--primary);
  padding-top: 6px;
 transform: translateY(32px);
}


.ghost{
    display:inline-block;
    color:white;
    font-size:35px;padding-right:10px;
     animation: ghostFloat 3s ease-in-out infinite;
  }
   .avatar-img {
    padding:5px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      transform: translateY(26px);
      border: 2px solid orange;
    }
  </style>
</head>
<body>
  <div id="chat">
    <!-- Header with Lottie -->
    <header>
      <div class="header-left">
       
      <h1 style="font-size:35px;color:white;font-weight:1000px;">Xfinity</h1>
      </div>
      <div class="header-center">
        <i class="fas fa-ghost ghost"></i>  In Action!
      </div>
      <div class="header-right">
        <i class="fa-solid fa-screwdriver-wrench"></i> #Ghost in the Garage!
      </div>
    </header>
    

    <!-- Chat messages -->
    <div id="messages">
      
    </div>

    <!-- Typing indicator -->
    <div id="typing-container">
      
<div class="typing">
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
      </div>
    </div>

    <!-- Input area -->
    <div id="input-area">
      <input type="text" id="userInput" placeholder="Ask Xyle" autocomplete="off" />
      <button id="sendBtn"><i class="fas fa-paper-plane"></i>Send</button>
      <button id="reset"><i class="fas fa-undo"></i>New Chat</button>
    </div>
  </div>

  <script>
    window.onload = () => {
      const messages = document.getElementById('messages');
      const input = document.getElementById('userInput');
      const sendBtn = document.getElementById('sendBtn');
      const resetBtn = document.getElementById('reset');
      const typingContainer = document.getElementById('typing-container');

      function stripMarkdown(text) {
        return text.replace(/\*/g, '');
      }

      function showTyping() {
        typingContainer.style.display = 'block';
      }
      function hideTyping() {
        typingContainer.style.display = 'none';
      }

      function typeWriter(el, txt, speed, cb) {
        let i = 0;
        function type() {
          if (i < txt.length) {
            el.innerHTML += txt[i] === '\n' ? '<br>' : txt[i];
            i++;
            setTimeout(type, speed);
          } else if (cb) cb();
        }
        type();
      }

     function addBotMessage(msg) {
 
  messages.scrollTop = messages.scrollHeight;
  
   
    const wrapper = document.createElement('div');
    wrapper.style.display = 'flex';
    wrapper.style.alignItems = 'flex-start';
    wrapper.style.gap = '10px';
    wrapper.style.margin = '1.5rem 0';

   // Replace icon with Lottie animation
  const lottie = document.createElement('lottie-player');
  lottie.setAttribute('src', 'https://lottie.host/7751efa9-d608-41fc-8a14-87c9e5090379/7lSyrOVa8q.json'); // replace with your actual Lottie URL
  lottie.setAttribute('background', 'transparent');
  lottie.setAttribute('speed', '1');
  lottie.style.width = '80px';
  
 
  lottie.style.height = '80px';
  lottie.setAttribute('loop', '');
  lottie.setAttribute('autoplay', '');
    
    const div = document.createElement('div');
    div.className = 'message bot';
    
   wrapper.appendChild(lottie);
    wrapper.appendChild(div);
    messages.appendChild(wrapper);
    
    typeWriter(div, stripMarkdown(msg), 15);
    messages.scrollTop = messages.scrollHeight;
  
}

 function addwelcomeBotMessage(msg) {
 
  messages.scrollTop = messages.scrollHeight;
    showTyping()
  
   setTimeout(() => {
        hideTyping();
    const wrapper = document.createElement('div');
    wrapper.style.display = 'flex';
    wrapper.style.alignItems = 'flex-start';
    wrapper.style.gap = '10px';
    wrapper.style.margin = '1.5rem 0';

   // Replace icon with Lottie animation
  const lottie = document.createElement('lottie-player');
  lottie.setAttribute('src', 'https://lottie.host/7751efa9-d608-41fc-8a14-87c9e5090379/7lSyrOVa8q.json'); // replace with your actual Lottie URL
  lottie.setAttribute('background', 'transparent');
  lottie.setAttribute('speed', '1');
  lottie.style.width = '80px';
  
 
  lottie.style.height = '80px';
  lottie.setAttribute('loop', '');
  lottie.setAttribute('autoplay', '');
    
    const div = document.createElement('div');
    div.className = 'message bot';
    
   wrapper.appendChild(lottie);
    wrapper.appendChild(div);
    messages.appendChild(wrapper);
    
    typeWriter(div, stripMarkdown(msg), 15);
    messages.scrollTop = messages.scrollHeight;
    }, 800 + Math.random()*300);
  
}

function addUserMessage(txt) {
  const wrapper = document.createElement('div');
  wrapper.style.display = 'flex';
  wrapper.style.alignItems = 'flex-start';
  wrapper.style.justifyContent = 'flex-end';
  wrapper.style.gap = '10px';
  wrapper.style.margin = '1.5rem 0';

  const div = document.createElement('div');
  div.className = 'message user';
  div.textContent = txt;

   const img = document.createElement('img');
        img.src = '<?= $this->session->userdata("avatar"); ?>';
        img.alt = 'User Avatar';
        img.className = 'avatar-img';

  wrapper.appendChild(div);
  wrapper.appendChild(img);
  messages.appendChild(wrapper);
  messages.scrollTop = messages.scrollHeight;
}


      sendBtn.onclick = () => {
        const txt = input.value.trim();
        if (!txt) return;
        addUserMessage(txt);
         showTyping();
        input.value = '';
        fetch('<?= site_url("Chat/ask") ?>', {
          method: 'POST',
          headers: {'Content-Type':'application/x-www-form-urlencoded'},
          body: 'message=' + encodeURIComponent(txt)
        })
        .then(r => r.json())
         .then(d => {
    // 👇 Hide animation before displaying the response
    hideTyping();
    addBotMessage(d.response);
  })
       .catch(_ => {
    hideTyping();
    addBotMessage('Sorry, something went wrong.');
  });
      };

      resetBtn.onclick = () => {
          showTyping()
            setTimeout(() => {
              hideTyping();
        fetch('<?= site_url("chat/reset") ?>').then(() => {
          messages.innerHTML = '';
          addBotMessage('👋 Welcome!\nHi there! I’m Xyle, your AI automobile assistant. Ask me anything about your vehicle and I’ll guide you step-by-step.');
        });
        }, 800 + Math.random()*300);
      };

      input.addEventListener('keypress', e => { if (e.key === 'Enter') sendBtn.click(); });
      
      addwelcomeBotMessage('👋 Welcome!\nHi there! I’m **Xyle**, your AI automobile assistant. Ask me anything about your vehicle and I’ll guide you step-by-step.');

    };
  </script>
</body>
</html>
