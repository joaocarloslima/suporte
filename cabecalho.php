<div class="ui secondary pointing menu">
    <a href="chamados.php" class="item <?php echo (basename($_SERVER['PHP_SELF'])=='chamados.php')?'active':''; ?>">Chamados</a>
    <a href="usuarios.php" class="item <?php echo (basename($_SERVER['PHP_SELF'])=='usuarios.php')?'active':''; ?>">Usuários</a>
    <a href="locais.php" class="item <?php echo (basename($_SERVER['PHP_SELF'])=='locais.php')?'active':''; ?>">Locais</a>
    <a href="equipamentos.php" class="item <?php echo (basename($_SERVER['PHP_SELF'])=='equipamentos.php')?'active':''; ?>">Equipamentos</a>
    <a href="perfil.php" class="item <?php echo (basename($_SERVER['PHP_SELF'])=='perfil.php')?'active':''; ?>">Perfil</a>
    <div class="right menu"><a href="../logar.php" class="ui item">Sair</a></div>
  </div>