<?php 
$button_text = get_sub_field('button'); 
?>

<?php if ($button_text): ?>
    <a href="#" 
       class="btn"
       style="
           font-size: 1rem;
           font-family:' Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
           margin-left: 1rem;
           border-radius: 50px;
           padding: 0.6rem 1rem;
           background: #1a5428;
           color: white;
           text-decoration: none;
           display: inline-block;
       ">
        <?php echo esc_html($button_text); ?>
    </a>
<?php endif; ?>
