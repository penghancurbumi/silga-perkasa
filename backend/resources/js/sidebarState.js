export let sidebarState = {
  expanded: true
}

let _updateSidebar = null;

export function registerUpdateSidebar (fn) {
  _updateSidebar = fn
}

export function updateSidebar (){
  _updateSidebar?.()
}