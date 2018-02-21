<div class="form-group">
    <label for="username" class="control-label col-sm-2">Username</label>
    <div class="col-sm-10"><input type="text" id="username" name="username" size="40" maxlength="40" minlength="2" required="" placeholder="username"></div>
</div>
<div class="row">
    <div class="col-lg-3"><label for="password">Password</label></div>
    <div class="col-lg-7"><input type="password" id="password" name="password" size="40" maxlength="40" minlength="2" required=""> <button class="btn btn-default" id="lihat" type="button">lihat password</button></div>
</div>
<div class="row">
    <div class="col-lg-3"><label for="email">Email</label></div>
    <div class="col-lg-7"><input type="email" id="email" name="email" size="40" maxlength="40" minlength="12" required=""></div>
</div>
<div class="row">
    <div class="col-lg-3"><label for="status">Status</label></div>
    <div class="col-lg-7">
        <input type="radio" name="status" required="" value="single">Single<br>
        <input type="radio" name="status" value="inRelationship">In Relationship<br>
        <input type="radio" name="status" value="menikah">Menikah<br>
        <input type="radio" name="status" value="jombloAbadi">Jomblo abadi<br>
    </div>
</div>
<div class="row">
    <div class="col-lg-3"><label for="hobi">Hobi</label></div>
    <div class="col-lg-7">
        <select id="hobi" name="hobi" required="">
            <option value="sepak bola">sepak bola</option>
            <option value="moto GP">moto GP</option>
            <option value="memasak">memasak</option>
            <option value="makan">makan</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-lg-3"><label for="makanan">Makanan Fav</label></div>
    <div class="col-lg-7">
        <input type="checkbox" name="makanan[]" maxlength="3" minlength="2" value="bakso">Bakso<br>
        <input type="checkbox" name="makanan[]" value="sate">Sate<br>
        <input type="checkbox" name="makanan[]" value="rujak">Rujak<br>
        <input type="checkbox" name="makanan[]" value="tipatcantok">Tipat Cantok<br>
        <input type="checkbox" name="makanan[]" value="siomay">Siomay<br>
    </div>
</div>
<div class="row">
    <div class="col-lg-3"><label for="profil">Profil</label></div>
    <div class="col-lg-7">
        <textarea name="profil" id="profil" cols="40" rows="5"></textarea>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">&nbsp;</div>
    <div class="col-lg-7"><input type="submit" name="submit" value="kirim" class="btn btn-primary"></div>
</div>