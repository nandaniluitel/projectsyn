"use strict";(self.webpackChunk_N_E=self.webpackChunk_N_E||[]).push([[4814],{54848:function(e,t,i){i.d(t,{Z:function(){return g}});var n=i(72438),r=i(46),a=i(32148),s=i(19841),l=i(83737),o=i(70079),c=i(84692),d=i(68498),u=i(81147),m=i(83924),f=i(41198),x=i(49641),p=i(51264),b=i(35250);function v(e,t){var i=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),i.push.apply(i,n)}return i}function h(e){for(var t=1;t<arguments.length;t++){var i=null!=arguments[t]?arguments[t]:{};t%2?v(Object(i),!0).forEach(function(t){(0,n.Z)(e,t,i[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):v(Object(i)).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(i,t))})}return e}function j(e){let{isDesktopNavCollapsed:t}=e;return(0,b.jsx)(l.E.div,{initial:!1,transition:{duration:.165},animate:{x:t?"0":"260px"},style:{rotate:t?180:0,y:"-50%"},className:(0,s.default)("fixed left-0 top-1/2 z-40"),children:(0,b.jsx)("button",{onClick:u.vm.toggleDesktopNavCollapsed,children:(0,b.jsxs)(r.u,{side:"right",label:t?(0,b.jsx)(c.Z,h({},y.openSidebar)):(0,b.jsx)(c.Z,h({},y.closeSidebar)),sideOffset:4,children:[(0,b.jsx)(l.E.div,{className:"flex h-[72px] w-8 items-center justify-center",variants:{rest:{},hover:{}},initial:!1,whileHover:["hover","arrow"],animate:["rest",t?"arrow":"line"],children:(0,b.jsxs)(l.E.div,{className:"flex h-6 w-6 flex-col items-center",children:[(0,b.jsx)(l.E.div,{className:"h-3 w-1 rounded-full",variants:{line:{rotate:"0deg",y:".15rem"},arrow:{rotate:"15deg",y:".15rem"},rest:{background:"var(--text-quaternary)"},hover:{background:"var(--text-primary)"}}}),(0,b.jsx)(l.E.div,{className:"h-3 w-1 rounded-full",variants:{line:{rotate:"0deg",y:"-.15rem"},arrow:{rotate:"-15deg",y:"-.15rem"},rest:{background:"var(--text-quaternary)"},hover:{background:"var(--text-primary)"}}})]})}),(0,b.jsx)(a.T,{children:t?(0,b.jsx)(c.Z,h({},y.openSidebar)):(0,b.jsx)(c.Z,h({},y.closeSidebar))})]})})})}function g(e){let{children:t,hideNavigation:i=!1,mobileHeaderContent:n,mobileHeaderRightContent:r,mobileHeaderBottomContent:a,sidebar:l,forceOpenDesktopSidebar:c=!1}=e,d=(0,m.w$)(),v=(0,u.xH)(),h=[],y=null;o.Children.forEach(t,e=>{o.isValidElement(e)&&(e.type===g.Sidebars?y=e:h.push(e))});let w=(0,f.Qr)(),k=d&&!i&&null!=l;return(0,b.jsxs)("div",{className:"relative z-0 flex h-full w-full overflow-hidden",children:[k?(0,b.jsx)(x.Z,{children:(0,b.jsx)(p.l6,{forceOpenDesktopSidebar:c,children:(0,b.jsx)("div",{className:(0,s.default)("flex h-full min-h-0 flex-col"),children:l})})}):null,(0,b.jsxs)("div",{className:"relative flex h-full max-w-full flex-1 flex-col overflow-hidden",children:[!d&&!i&&(0,b.jsx)(x.Z,{children:(0,b.jsx)(p.Vs,{onClickOpenSidebar:()=>u.vm.toggleActiveSidebar("mobile-nav"),sidebar:l,rightContent:r,bottomContent:a,children:n})}),(0,b.jsxs)("main",{className:"relative h-full w-full flex-1 overflow-auto transition-width",children:[(0,b.jsx)(x.Z,{children:k&&!w&&(0,b.jsx)(j,{isDesktopNavCollapsed:v})}),h]})]}),y]})}g.Sidebars=function(e){let{children:t}=e;return(0,b.jsx)(b.Fragment,{children:t})};let y=(0,d.vU)({closeSidebar:{id:"Stage.closeSidebar",defaultMessage:"Close sidebar"},openSidebar:{id:"Stage.openSidebar",defaultMessage:"Open sidebar"}})},51264:function(e,t,i){i.d(t,{MP:function(){return S},Nz:function(){return P},Vs:function(){return D},l6:function(){return B}});var n=i(72438),r=i(57798),a=i(63081),s=i(5214),l=i(11397),o=i(8880),c=i(15886),d=i(95981),u=i(53265),m=i(19841),f=i(83737),x=i(16215),p=i(70079),b=i(9063),v=i(84692),h=i(68498),j=i(81147);i(83924);var g=i(46),y=i(41198),w=i(9982),k=i(35250);let N=["onClick","className"],M=["onClick"];function O(e,t){var i=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),i.push.apply(i,n)}return i}function C(e){for(var t=1;t<arguments.length;t++){var i=null!=arguments[t]?arguments[t]:{};t%2?O(Object(i),!0).forEach(function(t){(0,n.Z)(e,t,i[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):O(Object(i)).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(i,t))})}return e}function S(e){let{onClick:t,className:i}=e,n=(0,r.Z)(e,N);return(0,k.jsx)(w.zV,C({onClick:t,className:(0,m.default)(i,"flex-grow overflow-hidden")},n))}function P(e){let{historyDisabled:t,onNewChatButtonClick:i}=e,n=(0,b.Z)(),{isUserUnauthenticated:r,isLoading:a}=(0,o.EH)(),l=(0,y.Qr)();return a?null:r?(0,k.jsx)(E,{className:"mr-3"}):(0,k.jsx)(g.u,{label:t?n.formatMessage({id:"/CxV1V",defaultMessage:"Clear chat"}):n.formatMessage({id:"Cvr6Bs",defaultMessage:"New chat"}),children:(0,k.jsx)(T,{onClick:()=>{u.A.logNewChatButtonClicked({location:"Mobile header"}),i()},children:t?(0,k.jsx)(s.Ezi,{className:(0,m.default)(l?"icon-lg mx-2.5":"icon-sm","juice:text-token-text-secondary")}):(0,k.jsx)(s.bl$,{className:(0,m.default)(l?"icon-lg mx-2.5":"icon-sm","juice:text-token-text-secondary")})})})}function T(e){let{onClick:t}=e,i=(0,r.Z)(e,M);return(0,k.jsx)("button",C({type:"button",className:"px-3",onClick:t},i))}function E(e){let{className:t}=e,{navigateToAuth:i}=(0,o.EH)();return(0,k.jsx)(a.z,{as:"button",size:"small",color:"primary",className:t,onClick:()=>{let e=i({authType:"signup"});u.A.logSignUpButtonClicked({location:"Mobile Chat Stage Header",provider:e})},children:(0,k.jsx)(v.Z,C({},F.signUpButtonText))})}let Z=e=>{let{onClose:t,sidebarOpen:i,children:n}=e;return(0,k.jsx)(c.u.Root,{show:i,as:p.Fragment,children:(0,k.jsxs)(d.V,{as:"div",className:"relative",onClose:t,children:[(0,k.jsx)(c.u.Child,{as:p.Fragment,enter:"transition-opacity ease-linear duration-300",enterFrom:"opacity-0",enterTo:"opacity-100",leave:"transition-opacity ease-linear duration-300",leaveFrom:"opacity-100",leaveTo:"opacity-0",children:(0,k.jsx)("div",{className:"fixed inset-0 bg-black/50 dark:bg-black/75"})}),(0,k.jsxs)("div",{className:"fixed inset-0 flex",children:[(0,k.jsx)(c.u.Child,{as:p.Fragment,enter:"transition ease-in-out duration-300 transform",enterFrom:"-translate-x-full",enterTo:"translate-x-0",leave:"transition ease-in-out duration-300 transform",leaveFrom:"translate-x-0",leaveTo:"-translate-x-full",children:(0,k.jsxs)(d.V.Panel,{className:"relative flex w-full max-w-xs flex-1 flex-col bg-token-sidebar-surface-primary",children:[(0,k.jsx)(c.u.Child,{as:p.Fragment,enter:"ease-in-out duration-300",enterFrom:"opacity-0",enterTo:"opacity-100",leave:"ease-in-out duration-300",leaveFrom:"opacity-100",leaveTo:"opacity-0",children:(0,k.jsx)("div",{className:"absolute right-0 top-0 -mr-12 pt-3.5",children:(0,k.jsxs)("button",{type:"button",className:"ml-1 flex h-10 w-10 items-center justify-center text-white focus:outline-none focus:ring-0 focus-visible:outline-white juice:hidden",onClick:t,children:[(0,k.jsx)("span",{className:"sr-only",children:(0,k.jsx)(v.Z,C({},F.closeSidebar))}),(0,k.jsx)(l.v7,{className:"icon-md"})]})})}),n]})}),(0,k.jsx)("div",{className:"w-14 flex-shrink-0"})]})]})})},D=e=>{let{onClickOpenSidebar:t,children:i,sidebar:n,rightContent:r,bottomContent:a}=e,l=(0,j.tN)(e=>e.activeSidebar),o=(0,x.useRouter)().asPath;return(0,p.useEffect)(()=>{"mobile-nav"===l&&j.vm.setActiveSidebar(!1)},[o]),(0,k.jsxs)(k.Fragment,{children:[(0,k.jsxs)("div",{className:"sticky top-0 z-10 flex min-h-[40px] items-center justify-center border-b border-token-border-medium bg-token-main-surface-primary pl-1 juice:min-h-[60px] juice:border-transparent md:hidden",children:[(0,k.jsxs)("button",{type:"button",className:"absolute bottom-0 left-0 top-0 inline-flex items-center justify-center rounded-md px-3 hover:text-token-text-primary focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white active:opacity-50",onClick:t,children:[(0,k.jsx)("span",{className:"sr-only",children:(0,k.jsx)(v.Z,C({},F.openSidebar))}),(0,k.jsx)(s.Oqj,{className:"icon-lg juice:mx-2.5 juice:text-token-text-secondary"})]}),i,null!=r&&(0,k.jsx)("div",{className:"absolute bottom-0 right-0 top-0 flex items-center",children:r})]}),a&&(0,k.jsx)("div",{className:"flex w-full items-center justify-center bg-token-main-surface-primary",children:a}),(0,k.jsx)(Z,{onClose:()=>{j.vm.setActiveSidebar(!1)},sidebarOpen:"mobile-nav"===l,children:n})]})};function B(e){let{forceOpenDesktopSidebar:t,children:i}=e,n=(0,p.useRef)(null),r=(0,j.xH)()&&!t;return(0,k.jsx)(f.E.div,{className:"flex-shrink-0 overflow-x-hidden bg-token-sidebar-surface-primary",ref:n,initial:!1,animate:{width:r?0:"260px",transition:{duration:.165,ease:"easeOut"}},onAnimationStart:()=>{n.current&&(n.current.style.visibility="visible")},onAnimationComplete:()=>{n.current&&r&&(n.current.style.visibility="hidden")},children:(0,k.jsx)("div",{className:"h-full w-[260px]",children:(0,k.jsx)("div",{className:"flex h-full min-h-0 flex-col",children:i})})})}let F=(0,h.vU)({closeSidebar:{id:"navigation.closeSidebar",defaultMessage:"Close sidebar"},openSidebar:{id:"navigation.openSidebar",defaultMessage:"Open sidebar"},signUpButtonText:{id:"navigation.signUpButtonText",defaultMessage:"Sign up"}})},72118:function(e,t,i){i.d(t,{Z:function(){return u}});var n=i(81147),r=i(91530),a=i.n(r),s=i(9063),l=i(68498),o=i(3806),c=i(9598),d=i(35250);function u(e){let{workspace:t}=e,i=(0,s.Z)(),r=(0,n.EV)(n.B.InviteUsersToWorkspace);return(0,d.jsx)(o.Z,{size:"custom",className:"max-w-lg text-sm",isOpen:r,onClose:a(),type:"success",title:null!=t.data.name?i.formatMessage(m.inviteMemberModalTitle,{workspaceName:t.data.name}):i.formatMessage(m.inviteMemberModalTitleUntitledWorkspace),description:i.formatMessage(m.inviteMemberModalDescription),children:(0,d.jsx)(c.Z,{workspace:t,canResendInviteEmails:!0,onCancel:()=>n.vm.closeModal(n.B.InviteUsersToWorkspace),onSuccess:()=>n.vm.closeModal(n.B.InviteUsersToWorkspace),cancelButtonText:i.formatMessage(m.inviteMemberInviteCancelButton)})})}let m=(0,l.vU)({inviteMemberInviteCancelButton:{id:"adminPage.inviteMemberInviteCancelButton",defaultMessage:"Cancel"},inviteMemberModalTitle:{id:"adminPage.inviteMemberModalTitle",defaultMessage:"Invite members to the {workspaceName} workspace"},inviteMemberModalTitleUntitledWorkspace:{id:"adminPage.inviteMemberModalTitleUntitledWorkspace",defaultMessage:"Invite members to this workspace"},inviteMemberModalDescription:{id:"adminPage.inviteMemberModalDescription",defaultMessage:"This workspace is private, only select members and roles can use this workspace. This workspace is opted out of training."},fileTooLargeWarning:{id:"adminPage",defaultMessage:"File is too large. Please upload a CSV file smaller than {maxSize}."}})}}]);
//# sourceMappingURL=4814-fed901f8bc2a9cb2.js.map