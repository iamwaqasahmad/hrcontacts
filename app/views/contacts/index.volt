
{{ content() }}

<div align="left" class="create-btn">
    {{ link_to("contacts/new", "Create Contacts", "class": "btn btn-primary") }}
</div>

{{ form("contacts/index") }}
  <div class="row">
    <div class="col-sm-3">
      <input type="text" name="first_name" class="form-control" placeholder="First name">
    </div>
    <div class="col-sm-3">
      <input type="text" name="last_name" class="form-control" placeholder="Last name">
    </div>
    <div class="col-sm-3">
          <input type="text" name="phone_no" class="form-control" placeholder="Phone No">
    </div>
    <div class="col-sm-3">
              <input type="email" name="email" class="form-control" placeholder="Email">
        </div>

  </div>
  <div class="control-group float-sm-right search-btn">
           {{ submit_button("Search", "class": "btn btn-primary") }}
  </div>
</form>

</fieldset>

</form>


{% for contacts in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" id="contacts-table" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone No</th>
            <th>Active</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ contacts.id }}</td>

            <td>{{ contacts.first_name }} {{ contacts.last_name }} </td>
            <td>{{ contacts.email }}</td>
             <td>{{ contacts.phone_no }}</td>
            <td width="7%">{{ link_to("contacts/edit/" ~ contacts.id, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default edit") }}</td>
            <td width="7%">{{ link_to("contacts/delete/" ~ contacts.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("contacts/index", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("contacts/index?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("contacts/index?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("contacts/index?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
    {% endif %}
{% else %}
    <div class="no-contacts alert alert-info">
        No contacts are recorded
    </div>
{% endfor %}

