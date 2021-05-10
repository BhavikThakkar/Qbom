<?php include('header.php'); ?>

<style>
.header-section, .footer-section{
    display: none;
}
</style>

<div style="text-align: center;margin-top: 320px;">Não atualize, você está redirecionando para o gateway de pagamento ...</div>

<script type="text/javascript">
var delay = 5000; 
setTimeout(function()
{ 
	alert('Obrigado por comprar o Plano de Assinatura.');
	window.location = 'index.php'; 
}, delay);
</script>

<?php include('footer.php'); ?>