    <div id="container">
      <div id="content_panel">
        <table>
          <tr>
            <th></th>
            <th>Title</th>
            <th>Author</th>
            <th>Date Time Submitted</th>
          </tr>
<?php

?>
          <tr>
            <td><button type="button" id="paper_link" onclick="getPaperInfo()">View Paper</button><p id="paper_abstract" hidden><?php  ?></p></td>
            <td><a id="paper_a" title="<?php  ?>"><?php  ?></a></td>
            <td><a id=""><?php ?></a></td>
            <td><?php ?></td>
          </tr>
<?php ?>
        </table>
      </div>
      <div id="content_view_panel" hidden>
        <div id="pdf_container">
          <embed id="paper_pdf" src="" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
        </div>
        <div id="abstract_container">
          <p id="paper_abstract">

          </p>
        </div>
      </div>
      <div id="content_view_more_panel" hidden>

      </div>
    </div>
