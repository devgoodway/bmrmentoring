<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">공지사항</h1>
    <?php echo $_POST[contents]; ?>
    <form action="index.php?id=notice" method="post">
        <textarea name="contents" id="editor"></textarea>
        <input type="submit" value="submit">
    </form>
</div>