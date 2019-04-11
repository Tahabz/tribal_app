

<h1 class="text-center mt-3">Manager <?= $this->session->userdata['username'];?> Dashboard</h1>
<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($leaves as $leave): ?>
        <tr>
            <th scope="row"><?= $leave['id_user'];?></th>
            <td><?= $leave['name_user'];?></td>
            <td>
            <form action="decline" method="post">
                <input type="hidden" name="id_conge" value="<?= $leave['id_conge'];?>">
                <input type="hidden" name="id_user" value="<?= $leave['id_user'];?>">
                <input type="submit" value="Decline" class="btn btn-danger">
            </form>
            </form>
            </td>
            <td><a href="accept/<?= $leave['id_conge'].'/'.$leave['id_user'];?>" class="btn btn-success">Accept</a></td>
        </tr>
    <?php endforeach;?>
  </tbody>
</table>