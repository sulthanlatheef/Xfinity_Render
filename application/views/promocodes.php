<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Promocode</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

  <style>
    /* ===== Global Variables ===== */
    :root{
      --accent-1:#ff9a00;
      --accent-2:#ff3d00;
      --card-bg:rgba(255,255,255,0.35);
      --card-border:rgba(255,255,255,0.55);
      --txt:#3d2b1f;
      --danger:#c62828;
    }

    /* ===== Reset / Base ===== */
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    html,body{height:100%;}
    body{
      font-family:"Poppins",sans-serif;
      color:var(--txt);
      display:flex;
      align-items:center;
      justify-content:center;
      overflow-x:hidden;
      background:linear-gradient(130deg,#fff7ed 0%,#ffe2c2 40%,#ffdcb3 70%,#ffefd9 100%);
      background-size:200% 200%;
      animation:bgShift 12s ease-in-out infinite;
    }
    @keyframes bgShift{
      0%,100%{background-position:0 0;}
      50%{background-position:100% 100%;}
    }

    /* ===== Floating Balloons ===== */
    .balloon{
      position:fixed;
      bottom:-150px;
      font-size:2.2rem;
      opacity:.65;
      animation:floatUp 12s linear infinite;
      pointer-events:none;
    }
    .balloon:nth-child(2){left:20%;animation-delay:2s;}
    .balloon:nth-child(3){left:40%;animation-delay:4s;}
    .balloon:nth-child(4){left:60%;animation-delay:1s;}
    .balloon:nth-child(5){left:80%;animation-delay:3s;}
    @keyframes floatUp{
      0%{transform:translateY(0) rotate(0deg);}
      100%{transform:translateY(-110vh) rotate(360deg);}
    }

    /* ===== Card / Container ===== */
    .container{
      width:min(90%,480px);
      backdrop-filter:blur(18px);
      background:var(--card-bg);
      border:1px solid var(--card-border);
      border-radius:22px;
      padding:48px 36px 40px;
      box-shadow:0 18px 48px rgba(0,0,0,0.18);
      position:relative;
      transition:transform .35s;
    }
    .container:hover{transform:translateY(-8px);}
    
    /* ---- Header ---- */
    .header{text-align:center;margin-bottom:34px;}
    .header h2{
      font-size:2.1rem;
      background:linear-gradient(90deg,var(--accent-1),var(--accent-2));
      -webkit-background-clip:text;
      color:transparent;
    }
    .header p{font-size:.95rem;margin-top:6px;}

    /* ---- Form grid ---- */
    form{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(140px,1fr));
      gap:22px;
    }
    .full{grid-column:1/-1;}

    /* ---- Inputs ---- */
    label{font-size:.85rem;margin-bottom:6px;display:block;}
    input,select{
      width:100%;padding:12px 14px;
      border:2px solid transparent;
      border-radius:12px;
      background:rgba(255,255,255,.65);
      font-size:.93rem;
      transition:border .25s,box-shadow .25s;
    }
    input:focus,select:focus{
      border-color:var(--accent-1);
      box-shadow:0 0 0 4px rgba(255,154,0,.25),0 0 8px 4px rgba(255,61,0,.15);
      outline:none;
    }
    /* invalid shake */
    @keyframes shake{
      0%,100%{transform:translateX(0);}
      20%,60%{transform:translateX(-6px);}
      40%,80%{transform:translateX(6px);}
    }
    .invalid{animation:shake 3s ease;}

    /* ---- Alert ---- */
    .alert{
      background:#ffecec;
      border-left:6px solid var(--danger);
      padding:14px 18px;
      border-radius:10px;
      font-size:.9rem;
      margin-bottom:10px;
      color:red;
    }

    /* ---- Button ---- */
    button[type=submit],.modal button{
      position:relative;
      overflow:hidden;
      border:none;
      border-radius:14px;
      background:linear-gradient(115deg,var(--accent-1),var(--accent-2));
      color:#fff;
      font-weight:600;
      text-transform:uppercase;
      letter-spacing:.5px;
      padding:15px;
      cursor:pointer;
      transition:transform .25s,box-shadow .25s;
    }
    button[type=submit]:hover{
      transform:translateY(-3px);
      box-shadow:0 10px 22px rgba(0,0,0,.18);
    }
    /* sheen */
    button[type=submit]::after{
      content:"";
      position:absolute;
      top:0;left:-110%;
      width:50%;height:100%;
      background:rgba(255,255,255,.4);
      transform:skewX(-20deg);
      transition:left .7s cubic-bezier(.4,.0,.2,1);
    }
    button[type=submit]:hover::after{left:120%;}

    /* ===== Navbar ===== */
    .navbar{
      position:fixed;top:0;left:0;right:0;
      height:60px;
      display:flex;align-items:center;justify-content:space-between;
      padding:0 24px;
      font-weight:600;font-size:1.05rem;
      color:#fff;
      background:linear-gradient(90deg,var(--accent-1),var(--accent-2));
      box-shadow:0 2px 8px rgba(0,0,0,.12);
      z-index:50;
      text-decoration:none;
    }
    body{padding-top:60px;}

    /* ===== Modal ===== */
    .modal-overlay{
      position:fixed;inset:0;
      display:none;align-items:center;justify-content:center;
      background:rgba(0,0,0,.55);z-index:100;
    }
    .modal{
      background:#fff;
      border-radius:18px;
      padding:36px 34px;
      max-width:320px;text-align:center;
      animation:bounce .5s ease;
    }
     .btn {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 8px 16px;
      font-size: 0.9rem;
      font-weight: 600;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
      transition: transform 0.1s ease, box-shadow 0.2s ease;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    @keyframes bounce{
      0%{transform:scale(.4);opacity:0;}
      70%{transform:scale(1.1);opacity:1;}
      100%{transform:scale(1);}
    }
    .modal h3{margin-bottom:12px;color:var(--accent-2);}
    .modal p{font-size:.95rem;margin-bottom:22px;}

    /* ===== Confetti left as-is ===== */
  </style>
</head>
<body>
  <nav class="navbar">
    <div>🎉 Promocode Creator</div>
     <div style="display: flex; gap: 12px; align-items: center;">
    <a href="<?= site_url('admin'); ?>" class="btn" style="background-color: white; color: var(--accent-2);">
      🏠 Home
    </a>
    <a href="<?= site_url('home/logoutadmin'); ?>" class="btn" style="background-color: #ffffff; color: var(--danger);">
      🔓 Logout
    </a>
    <span>Admin Panel</span>
  </div>
    
  </nav>

  <!-- 🎈 purely decorative balloons -->
  <div class="balloon">🎈</div>
  <div class="balloon">🎈</div>
  <div class="balloon">🎈</div>
  <div class="balloon">🎈</div>
  <div class="balloon">🎈</div>

  <!-- ===== Navbar ===== -->
  

  <!-- ===== Card ===== -->
  <div class="container">

    <div class="header">
      <h2>New Promocode</h2>
      <p>Generate a deal your users will love!</p>
    </div>

    <?php if (isset($error)): ?>
      <div class="alert full"><?php echo $error;?></div>
    <?php endif; ?>

    <?php if (validation_errors()): ?>
      <div class="alert full"><?php echo validation_errors(); ?></div>
    <?php endif; ?>

    <?php echo form_open('admin/create', ['id'=>'promoForm']); ?>

      <div class="field full">
        <label for="promocode">Promocode</label>
        <?php echo form_input([
          'name'=>'promocode','id'=>'promocode','type'=>'text',
          'value'=>set_value('promocode'),
          'placeholder'=>'E.g. SUPERSPRING25'
        ]); ?>
      </div>

      <div class="field">
        <label for="discount">Discount (₹)</label>
        <?php echo form_input([
          'name'=>'discount','id'=>'discount','type'=>'number','min'=>'1',
          'value'=>set_value('discount'),
          'placeholder'=>'500'
        ]); ?>
      </div>

      <div class="field">
        <label for="type">Type</label>
        <?php echo form_dropdown('type',[
          'common'=>'Common (unlimited)',
          'unique'=>'Unique (one-time)'
        ],set_value('type')); ?>
      </div>

      <button type="submit" class="full">Create Promocode</button>

    <?php echo form_close(); ?>
  </div>

  <!-- ===== Success Modal ===== -->
  <div class="modal-overlay" id="modalOverlay">
    <div class="modal">
      <h3>Success! 🎊</h3>
      <p>Your promocode has been created.</p>
      <button id="modalClose">OK</button>
    </div>
  </div>

  <!-- Confetti container kept -->
  <div id="confetti-container"></div>

  <script>
    /* ==== button sheen ripple not needed anymore ==== */

    /* ==== invalid shake + form guard ==== */
    document.getElementById('promoForm').addEventListener('submit',e=>{
      const code=document.getElementById('promocode');
      const disc=document.getElementById('discount');
      let valid=true;
      [code,disc].forEach(el=>{
        if(!el.value.trim()){
          el.classList.add('invalid');
          setTimeout(()=>el.classList.remove('invalid'),400);
          valid=false;
        }
      });
      if(!valid)e.preventDefault();
    });

    /* ==== modal + confetti ==== */
    <?php if ($this->session->flashdata('success')): ?>
      document.addEventListener('DOMContentLoaded',()=>{
        document.getElementById('modalOverlay').style.display='flex';
        launchConfetti();
      });
    <?php endif; ?>

    document.getElementById('modalClose').addEventListener('click',()=>{
      document.getElementById('modalOverlay').style.display='none';
      window.location='<?php echo site_url("Admin/promocodes"); ?>';
    });

    // ------- Confetti (same as before) -------
    function launchConfetti(){
      const container=document.getElementById('confetti-container');
      for(let i=0;i<80;i++){
        const conf=document.createElement('div');
        conf.className='confetti';
        conf.style.position='fixed';
        conf.style.width='8px';conf.style.height='16px';
        conf.style.left=Math.random()*innerWidth+'px';
        conf.style.top='-20px';
        conf.style.background=`hsl(${Math.random()*360},80%,60%)`;
        container.appendChild(conf);
        const fall=conf.animate([
          {transform:'translateY(0) rotate(0deg)'},
          {transform:`translateY(${innerHeight+40}px) rotate(${Math.random()*360}deg)`}
        ],{duration:3000+Math.random()*2000,easing:'ease-out'});
        fall.onfinish=()=>conf.remove();
      }
    }
  </script>
</body>
</html>
