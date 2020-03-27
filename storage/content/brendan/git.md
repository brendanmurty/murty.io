# Git

My public Git repositories on [GitHub](http://github.com/brendanmurty):

<ul id="repos-list"></ul>

<script>
var reposList = document.getElementById('repos-list'),
  projectsCount = document.getElementById('projects-count'),
  load = function(data){
    if (!data || !data.data || !data.data.length) return;
    var repositories = data.data,
      html = '';
    repositories.sort(function(a, b){
      var aFork = a.fork, bFork = b.fork;
      if (aFork && !bFork) return 1;
      if (!aFork && bFork) return -1;
      return new Date(b.pushed_at) - new Date(a.pushed_at);
    });
    var l = repositories.length, w = 0, f = 0;
    for (var i=0; i<l; i++){
      var r = repositories[i],
        fork = r.fork ? ' class="fork"' : '',
        watchers = r.watchers,
        forks = r.forks;
      w += r.watchers;
      f += r.forks;
      html += '<li' + fork + '>'
        + '<a href="' + r.html_url + '">'
        + '<span class="info"><b class="language">' + (r.language || '') + '</b> <b class="stars">' + watchers + '</b> <b class="forks">' + forks + '</b></span>'
        + '<b>' + r.name + '</b> '
        + '<span class="desc">' + r.description + '</span>'
        + '</a>';
    }
    reposList.innerHTML = html;
  };
</script>
<script src="https://api.github.com/users/brendanmurty/repos?callback=load&per_page=100"></script>