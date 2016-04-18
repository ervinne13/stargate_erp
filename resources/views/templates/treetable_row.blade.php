<tr data-tt-id="<%= M_Module_id %>" data-tt-parent-id="<%= M_Parent %>">
    <td>
        <label class="module-check" data-parent-id="<%= M_Parent %>">
            <input type="checkbox" data-module="<%= M_Module_id %>" data-id="<%= M_Module_id %>" class="module-check">
        </label>
        <span class="tree-desc"><%= M_Description %></span>
    </td>
    <td>
        <% _.each(user_profile, function(profile){ %>        
        <span class="module-access-check-container">
            <label class="red-round-border">
                <input type="checkbox" data-id="<%= profile.user_access.UA_Access_id%>" class="module-access-check">
                <%= profile.user_access.UA_AccessName %>
            </label>
        </span>

        <% }); %>
    </td>
    <td>
        <% _.each(user_function, function(userFunction){ %>
        <span class="module-access-check-container">
            <label class="red-round-border">
                <input type="checkbox" data-id="<%= userFunction.module_function.F_Function_id%>" class="module-access-check">
                <%= userFunction.module_function.F_FunctionName %>
            </label>
        </span>

        <% }); %>
    </td>
</tr>