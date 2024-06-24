"use strict";(self.webpackChunk_N_E=self.webpackChunk_N_E||[]).push([[6469],{87685:function(e,t,r){r.d(t,{$:function(){return b},m:function(){return v}});var n=r(88324),s=r(69677),a=r(81147),i=r(8880),o=r(83924),l=r(19841),c=r(9063),u=r(40392),d=r(96331),f=r(46),m=r(5214),h=r(62190),p=r(90126),g=r(25265),y=r(35250);function v(e){let{clientThreadId:t,isInPopover:r=!1}=e,a=(0,s.XK)(t),o=(0,n.t)(),{isUserUnauthenticated:l}=(0,i.EH)(),c=(0,s.eV)(t),f=(0,s.Ao)(t),m=(0,u.V_)();return(0,y.jsxs)(y.Fragment,{children:[null!=o&&o.canInteractWithGizmos()?(0,y.jsx)(h.Dy,{currentGizmoId:c}):(0,y.jsxs)(y.Fragment,{children:[(0,y.jsx)(h.Vq,{isActive:void 0===c,isNewConversation:f}),(0,y.jsx)(p.Z,{})]}),!l&&(0,y.jsx)(d.Z,{activeId:m?void 0:a,isInPopover:r})]})}function b(e){let{className:t,onNewThread:r,historyDisabled:n}=e,s=(0,c.Z)(),i=(0,o.w$)();return(0,y.jsxs)("div",{className:(0,l.default)("flex justify-between",t),children:[(0,y.jsx)(f.u,{sideOffset:4,label:s.formatMessage({id:"e7SzX9",defaultMessage:"Close sidebar"}),children:(0,y.jsx)(g.W,{onClick:()=>{i?a.vm.toggleDesktopNavCollapsed():a.vm.toggleActiveSidebar("mobile-nav")},icon:i?m.BSo:m.Oqj,surfaceContext:"secondary"})}),(0,y.jsx)(f.u,{sideOffset:4,label:s.formatMessage({id:"OFyxqj",defaultMessage:"New chat"}),children:(0,y.jsx)(g.W,{onClick:()=>{i||a.vm.toggleActiveSidebar("mobile-nav"),r()},icon:n?m.Ezi:m.bl$,surfaceContext:"secondary"})})]})}},72554:function(e,t,r){r.d(t,{C:function(){return u}});var n=r(72438),s=r(91530),a=r.n(s),i=r(52959);function o(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),r.push.apply(r,n)}return r}function l(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?o(Object(r),!0).forEach(function(t){(0,n.Z)(e,t,r[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):o(Object(r)).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))})}return e}let c={showReferralInviteModal:!1},u=(0,i.Ue)()(e=>l(l({},c),{},{setShowReferralInviteModal:function(t){let r=arguments.length>1&&void 0!==arguments[1]?arguments[1]:a();e({showReferralInviteModal:t}),null==r||r()}}))},11978:function(e,t,r){r.d(t,{ZP:function(){return ec}});var n,s,a=r(25927),i=r(72438),o=r(21208),l=r(88324),c=r(81147),u=r(8880),d=r(70062),f=r(83924),m=r(32148),h=r(53265),p=r(52601),g=r(24115),y=r(19841),v=r(70079),b=r(37659),x=r(9063),j=r(84692),w=r(68498),O=r(21389),P=r(63081),M=r(40392);r(46);var k=r(5214),C=r(41198),N=r(62190),S=r(96140),_=r(72118),T=r(71727),E=r(73606),I=r(52866),Z=r(16215),D=r(59311),F=r(97641),A=r(65733),H=r(83737),L=r(61236),R=r(35250);function U(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),r.push.apply(r,n)}return r}function W(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?U(Object(r),!0).forEach(function(t){(0,i.Z)(e,t,r[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):U(Object(r)).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))})}return e}function z(e){let{showFreeTrialLoadingPayment:t,handleGetPaymentLink:r}=e,n=(0,x.Z)(),{data:s,isLoading:a,isSuccess:i}=(0,L.a)({queryKey:["claimedReferralInvite"],queryFn:()=>T.Z.getClaimedReferralInvite(),refetchOnMount:!1,refetchOnWindowFocus:!1,refetchInterval:!1,refetchOnReconnect:!1}),o=null==s?void 0:s.invite_code,{0:l,1:c}=(0,v.useState)(!1);if((0,v.useEffect)(()=>{o&&!l&&i&&(c(!0),g.m9.logEvent("chatgpt_referral_show_claimed_sidebar_menu_promo"),h.A.logEvent(I.M.chatgptReferralShowClaimedSidebartMenuPromo))},[o,c,l,i]),!o||a||!i)return null;let u=o.invite_metadata.invite_data,d=null!=u&&u.referral_trial_duration_months?(null==u?void 0:u.referral_trial_duration_months)>1?n.formatMessage(B.monthsOfBenefit,{referralTrialDurationMonths:null==u?void 0:u.referral_trial_duration_months}):n.formatMessage(B.daysOfBenefit,{referralTrialDurationDays:null==u?void 0:u.referral_trial_duration_days}):null;return(0,R.jsx)(H.E.div,{className:(0,y.default)("relative",{"cursor-progress opacity-50":t}),layout:"position",initial:{y:-10,opacity:1},animate:{y:0,opacity:1,transition:{duration:.1,ease:"easeIn"}},children:(0,R.jsxs)(q,{className:(0,y.default)(t&&"opacity-75"),onClick:()=>{t||((0,F.Vk)(!0),r())},children:[(0,R.jsxs)("div",{className:"flex w-full flex-row items-center justify-start gap-3 ",children:[(0,R.jsx)(b.E33,{className:"icon-sm shrink-0"}),(0,R.jsx)(j.Z,W(W({},B.freeTrialCta),{},{values:{duration:d}}))]}),!t&&(0,R.jsx)(k.tPq,{onClick:e=>{e.stopPropagation(),(0,F.zG)(!0),(0,F.H1)(!0)},className:"icon-md shrink-0 rounded-full p-0.5 text-token-text-tertiary opacity-50 transition-colors duration-200 hover:bg-[#0077FF] hover:text-red-500 group-hover:opacity-100"}),(0,R.jsx)("span",{className:"absolute top-11 h-0 w-0 border-l-8 border-r-8 border-t-8 border-l-transparent border-r-transparent border-t-[#0077FF] transition-colors duration-200 group-hover:border-t-[#0077FF]"})]})})}let q=O.Z.a(n||(n=(0,a.Z)(["group relative mb-1 rounded-md hover:[#0077FF] bg-[#0077FF] flex px-3 min-h-[44px] py-1 items-center gap-3 transition-colors duration-200 dark:text-white cursor-pointer text-sm"]))),B=(0,w.vU)({freeTrialCta:{id:"PaymentMenuItems.freeTrialCta",defaultMessage:"Get {duration}!"},monthsOfBenefit:{id:"FreeTrialMenuItem.monthsOfBenefit",defaultMessage:"{referralTrialDurationMonths, plural, one {one month free} other {# months free}}"},daysOfBenefit:{id:"FreeTrialMenuItem.daysOfBenefit",defaultMessage:"{referralTrialDurationDays, plural, one {one day free} other {# days free}}"}});var V=r(9982),G=r(72554);function $(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),r.push.apply(r,n)}return r}function K(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?$(Object(r),!0).forEach(function(t){(0,i.Z)(e,t,r[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):$(Object(r)).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))})}return e}function X(){var e,t,r,n,s,a,i;let o=(0,Z.useRouter)(),c=(0,x.Z)(),u=(0,l.hz)(),d=(0,l.t)(),f=!d,m=null!==(e=null==d?void 0:d.hasPaidSubscription())&&void 0!==e&&e,p=null!==(t=null==d?void 0:d.hasClaimedFreeTrial())&&void 0!==t&&t,y=(0,v.useMemo)(()=>null==d?void 0:d.subscriptionAnalyticsParams,[d]),b=async()=>{(0,F.Vk)(!0),h.A.logEvent(I.M.clickAccountPaymentCheckout,y);try{let e=await T.Z.getCheckoutLink(u);o.push(e.url)}catch(e){A.m.warning(c.formatMessage(ee.paymentErrorWarning),{hasCloseButton:!0}),(0,F.Vk)(!1)}finally{}},j=(0,F.tS)(e=>e.didCloseFreeTrial),w=(0,F.tS)(e=>e.showFreeTrialLoadingPayment),O=!j&&p,P=null!==(r=null==d?void 0:d.wasPaidCustomer())&&void 0!==r&&r,M=null!==(n=null==d?void 0:d.isWorkspaceAccount())&&void 0!==n&&n,k=null!==(s=null==d?void 0:d.isPlus())&&void 0!==s&&s,C=!f&&!M&&(!1===k||null!==(a=null==u?void 0:u.includes(E.L0.Teams))&&void 0!==a&&a),{setShowReferralInviteModal:N}=(0,G.C)(e=>({setShowReferralInviteModal:e.setShowReferralInviteModal})),S=(0,v.useCallback)(()=>{g.m9.logEvent("chatgpt_referral_invite_sidebar_clicked"),h.A.logEvent(I.M.chatgptReferralInviteSidebarClicked,y),N(!0,()=>{h.A.logEvent(I.M.clickSidebarAccountPaymentMenuItem,y)})},[y,N]),_=null!==(i=null==d?void 0:d.isTeam())&&void 0!==i&&i;return(0,R.jsxs)(R.Fragment,{children:[((null==u?void 0:u.includes(E.a3))||m)&&(0,R.jsx)(J,{analyticsParams:y,handleReferralInvite:S}),!m&&O&&(0,R.jsx)(z,{showFreeTrialLoadingPayment:w,handleGetPaymentLink:b}),_&&(0,R.jsx)(Y,{}),C&&(0,R.jsx)(V.Vq,{onClick:O?()=>{w||((0,F.Vk)(!0),b())}:()=>{h.A.logEvent(I.M.clickSidebarAccountPaymentMenuItem,y);let e=o.asPath.split("#");o.push("".concat(e[0],"#pricing"))},className:"m-0 rounded-lg px-2",children:(0,R.jsx)("span",{className:"flex w-full flex-row flex-wrap-reverse justify-between",children:(0,R.jsx)("div",{className:"flex items-center gap-2",children:(0,R.jsx)(Q,{wasPaidCustomer:P,showFreeTrialLoadingPayment:w,hasPlusSubscription:k})})})})]})}let Q=e=>{let{wasPaidCustomer:t,showFreeTrialLoadingPayment:r,hasPlusSubscription:n}=e;return r?(0,R.jsx)(D.Z,{className:"icon-sm shrink-0"}):(0,R.jsxs)(R.Fragment,{children:[(0,R.jsx)("span",{className:"flex h-7 w-7 items-center justify-center rounded-full border border-token-border-light",children:(0,R.jsx)(k.X72,{className:"icon-sm shrink-0"})}),(0,R.jsx)("div",{className:"flex flex-col",children:t?(0,R.jsx)(j.Z,K({},ee.renewPlus)):(0,R.jsxs)(R.Fragment,{children:[(0,R.jsx)("span",{children:n?(0,R.jsx)(j.Z,K({},ee.createATeamWorkspace)):(0,R.jsx)(j.Z,K({},ee.upgradePlan))}),(0,R.jsx)("span",{className:"line-clamp-1 text-xs text-token-text-tertiary",children:n?(0,R.jsx)(j.Z,K({},ee.upgradeToTeamUpsell)):(0,R.jsx)(j.Z,K({},ee.upgradeToPlusUpsell))})]})})]})},Y=()=>{let e=(0,l.t)();return(0,R.jsxs)(R.Fragment,{children:[(0,R.jsx)(V.Vq,{onClick:()=>{c.vm.openModal(c.B.InviteUsersToWorkspace)},className:"rounded-lg",children:(0,R.jsx)("span",{className:"flex w-full flex-row flex-wrap-reverse justify-between",children:(0,R.jsxs)("span",{className:"flex items-center gap-2",children:[(0,R.jsx)("span",{className:"flex h-7 w-7 items-center justify-center rounded-full border border-token-border-light",children:(0,R.jsx)(k.pF9,{className:"icon-sm shrink-0"})}),(0,R.jsx)(j.Z,K({},ee.inviteMembers))]})})}),null!=e?(0,R.jsx)(_.Z,{workspace:e}):null]})},J=e=>{var t;let{analyticsParams:r,handleReferralInvite:n}=e,s=(0,l.hz)(),a=null!==(t=null==s?void 0:s.includes(E.a3))&&void 0!==t&&t,i=(0,l.t)(),{data:o}=(0,L.a)({queryKey:["referralInvites"],queryFn:()=>T.Z.getEligibleReferralInvites(),enabled:a}),c=i&&!i.isOrWasPaidCustomer()&&!i.hasPlusFeatures(),u=(null==o?void 0:o.invites_remaining)&&(null==o?void 0:o.invites_remaining)>0,d=c&&u,{0:f,1:m}=(0,v.useState)(!1);return((0,v.useEffect)(()=>{d&&!f&&(m(!0),g.m9.logEvent("chatgpt_referral_show_sidebar_menu_item"),h.A.logEvent(I.M.chatgptReferralShowSidebarMenuItem,r))},[d,m,f,r]),d)?(0,R.jsx)(V.Vq,{onClick:n,className:"rounded-lg",children:(0,R.jsx)("span",{className:"flex w-full flex-row flex-wrap-reverse justify-between",children:(0,R.jsxs)("span",{className:"flex items-center gap-2",children:[(0,R.jsx)("span",{className:"flex h-7 w-7 items-center justify-center rounded-full border border-token-border-light",children:(0,R.jsx)(k.pF9,{className:"icon-sm shrink-0"})}),(0,R.jsx)(j.Z,K({},ee.inviteReferral))]})})}):null},ee=(0,w.vU)({upgradePlan:{id:"PaymentMenuItems.upgradePlan",defaultMessage:"Upgrade plan"},createATeamWorkspace:{id:"PaymentMenuItems.createATeamWorkspace",defaultMessage:"Add Team workspace"},upgradeToTeamUpsell:{id:"PaymentMenuItems.upgradeToTeamUpsell",defaultMessage:"Collaborate on a Team plan"},upgradeToPlusUpsell:{id:"PaymentMenuItems.upgradeToPlusUpsell.0",defaultMessage:"Get GPT-4, DALL\xb7E, and more"},renewPlus:{id:"PaymentMenuItems.renewPlus",defaultMessage:"Renew Plus"},inviteReferral:{id:"PaymentMenuItems.inviteReferral",defaultMessage:"Refer a friend"},inviteMembers:{id:"PaymentMenuItems.inviteMembers.0",defaultMessage:"Invite members"},paymentErrorWarning:{id:"PaymentMenuItems.paymentErrorWarning",defaultMessage:"The payments page encountered an error. Please try again. If the problem continues, please visit help.openai.com."}});var et=r(14978),er=r(25494),en=r(46391);let es=()=>(0,L.a)({queryKey:["userSurvey"],queryFn:async()=>T.Z.getActiveUserSurvey()}),ea=()=>(0,er.D)({mutationFn:async e=>{let{surveyId:t,reason:r}=e;return T.Z.completeUserSurvey(t,r)},onSuccess:async()=>{en.E.invalidateQueries({queryKey:["userSurvey"]})}});function ei(){var e;let t=(0,x.Z)(),r=(0,f.w$)(),{0:n,1:s}=(0,v.useState)(!1),a=null===(e=es().data)||void 0===e?void 0:e.survey,i=ea(),o=e=>{s(!0),null!=a&&i.mutate({surveyId:a.id,reason:e})};return n||null==a?null:(0,R.jsx)("div",{className:"mx-1 mb-1 rounded-sm bg-brand-blue-800",children:(0,R.jsxs)("div",{className:"flex flex-col items-center justify-stretch gap-3 p-3 text-sm text-white",children:[(0,R.jsxs)("div",{className:"flex w-full items-start",children:[(0,R.jsxs)("div",{className:"flex flex-grow flex-col gap-1",children:[(0,R.jsx)("div",{className:"font-bold",children:(0,R.jsx)(j.Z,{id:"navigation.survey.title",defaultMessage:"We are asking a small group of people for their opinion"})}),(0,R.jsx)("div",{children:(0,R.jsx)(j.Z,{id:"navigation.survey.description",defaultMessage:"Could you spare few minutes to take a short survey?"})})]}),(0,R.jsx)("button",{className:"text-white/25 hover:text-white/40",onClick:()=>o("dismissed"),"aria-label":t.formatMessage({id:"navigation.survey.dismiss",defaultMessage:"Dismiss survey"}),children:(0,R.jsx)(k.tPq,{width:r?"20px":"24px",height:r?"20px":"24px"})})]}),(0,R.jsxs)("a",{href:a.link,target:"_blank",className:"flex w-full flex-row items-center justify-center gap-2 rounded bg-white/25 p-2 hover:bg-white/40",rel:"noreferrer",onClick:()=>o("link_clicked"),children:[(0,R.jsx)(k.Pfi,{className:"icon-sm"}),(0,R.jsx)(j.Z,{id:"navigation.survey.takeSurvey",defaultMessage:"Take survey"})]})]})})}function eo(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),r.push.apply(r,n)}return r}function el(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?eo(Object(r),!0).forEach(function(t){(0,i.Z)(e,t,r[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):eo(Object(r)).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))})}return e}function ec(e){let{onNewThread:t,currentGizmoId:r,navHeader:n,children:s,className:a}=e,i=(0,x.Z)(),o=(0,l.t)(),c=null==o?void 0:o.isWorkspaceAccount(),f=(0,v.useRef)(null),h=(0,M.V_)(),{openSettings:p}=(0,S.Fr)(),{isUserUnauthenticated:g}=(0,u.EH)();(0,v.useEffect)(()=>{M._P.getModifiedSettings()&&p()},[]);let w=(0,d.cQ)(),O=(0,v.useCallback)(()=>{t(),M._P.enableHistory({useLocalStorage:!w})},[t,w]),k=(0,R.jsxs)("div",{className:(0,y.default)("absolute left-0 top-0 z-20 w-full overflow-hidden transition-all duration-500",h?"visible max-h-72":"invisible max-h-0"),children:[(0,R.jsx)("div",{className:"px-3 py-3.5",children:(0,R.jsx)(N.jl,{gizmo:void 0,historyDisabled:!0,isActive:void 0===r})}),(0,R.jsxs)("div",{className:"bg-gray-900 px-4 py-3",children:[(0,R.jsx)("div",{className:"p-1 text-sm text-gray-100",children:(0,R.jsx)(j.Z,el({},em.chatHistoryOff))}),(0,R.jsx)("div",{className:"p-1 text-xs text-token-text-tertiary",children:(0,R.jsx)(j.Z,el(el({},c?em.chatHistoryOffDescriptionBusiness:em.chatHistoryOffDescription),{},{values:{learnMore:(0,R.jsx)("a",{href:"https://help.openai.com/en/articles/7730893",target:"_blank",className:"underline",rel:"noreferrer",children:(0,R.jsx)(j.Z,el({},em.learnMore))}),b:e=>(0,R.jsx)("strong",{children:e})}}))}),(0,R.jsxs)(P.z,{className:"mt-4 w-full",onClick:O,color:"primary",size:"medium",children:[(0,R.jsx)(b.$IY,{className:"icon-sm"}),(0,R.jsx)(j.Z,el({},em.enableChatHistory))]})]}),(0,R.jsx)("div",{className:"h-24 bg-gradient-to-t from-gray-900/0 to-gray-900"})]});return(0,R.jsx)(R.Fragment,{children:(0,R.jsxs)("div",{className:"relative h-full w-full flex-1 items-start border-white/20",children:[(0,R.jsx)(m.f,{asChild:!0,children:(0,R.jsx)("h2",{children:(0,R.jsx)(j.Z,el({},em.chatHistoryLabel))})}),(0,R.jsxs)("nav",{className:(0,y.default)("flex h-full w-full flex-col px-3 pb-3.5 juice:pb-0",a),"aria-label":i.formatMessage(em.chatHistoryLabel),children:[n,o&&!w&&!g&&k,(0,R.jsx)(ef,{ref:f,$disableScroll:h&&!w&&!g,children:s}),(0,R.jsx)(eu,{})]})]})})}function eu(){let{0:e}=(0,v.useState)(()=>{let e=p.bX.getCookie(p.cn.Workspace);return"string"==typeof e&&e!==o.b}),t=(0,l.t)(),r=(null==t?void 0:t.data)==null,{openSettings:n}=(0,S.Fr)(),{isUserUnauthenticated:s}=(0,u.EH)(),a=(0,C.Qr)(),i=(0,f.w$)();return e&&r||!t?null:s?(0,R.jsx)(ed,{}):(0,R.jsxs)("div",{className:"flex flex-col pt-2 empty:hidden juice:py-2 dark:border-white/20",children:[(0,R.jsx)(ei,{}),(0,R.jsx)(X,{}),(i||!a)&&a?null:(0,R.jsx)("div",{className:"flex w-full items-center",children:(0,R.jsx)("div",{className:"max-w-[100%] grow",children:(0,R.jsx)(et.W,{onClickSettings:()=>n()})})})]})}let ed=()=>{let{navigateToAuth:e}=(0,u.EH)();return(0,R.jsxs)("div",{children:[(0,R.jsxs)("div",{className:"mb-4 mt-2",children:[(0,R.jsx)("p",{className:"mb-1 text-sm font-medium text-token-text-primary",children:(0,R.jsx)(j.Z,el({},em.signUpOrLogIn))}),(0,R.jsx)("p",{className:"text-sm text-token-text-secondary",children:(0,R.jsx)(j.Z,{id:"NavigationContent.unauthSidebarSigninDesc",defaultMessage:"Save your chat history, share chats, and personalize your experience."})})]}),(0,R.jsxs)("div",{className:"flex flex-col space-y-2",children:[(0,R.jsx)(P.z,{as:"button",size:"medium",color:"primary",onClick:()=>{let t=e({authType:"signup"});h.A.logSignUpButtonClicked({location:"Sidebar bottom unit",provider:t}),g.m9.logEvent("chatgpt_sidebar_signup_button_clicked")},children:(0,R.jsx)(j.Z,el({},em.unauthSignupCta))}),(0,R.jsx)(P.z,{as:"button",size:"medium",color:"secondary",onClick:()=>{let t=e({authType:"login"});h.A.logLogInButtonClicked({location:"Sidebar bottom unit",provider:t}),g.m9.logEvent("chatgpt_sidebar_login_button_clicked")},children:(0,R.jsx)(j.Z,el({},em.unauthLoginCta))})]})]})},ef=O.Z.div(s||(s=(0,a.Z)(["flex-col flex-1 transition-opacity duration-500 -mr-2 pr-2\n  ",""])),e=>{let{$disableScroll:t}=e;return t?"overflow-y-hidden opacity-20 pointer-events-none":"overflow-y-auto"}),em=(0,w.vU)({chatHistoryLabel:{id:"NavigationContent.chatHistoryLabel",defaultMessage:"Chat history"},chatHistoryOff:{id:"NavigationContent.chatHistoryOff",defaultMessage:"Chat History is off for this browser."},chatHistoryOffDescription:{id:"NavigationContent.chatHistoryOffDescription",defaultMessage:"When history is turned off, new chats on this browser won't appear in your history on any of your devices, be used to train our models, or stored for longer than 30 days. <b>This setting does not sync across browsers or devices.</b> {learnMore}"},chatHistoryOffDescriptionBusiness:{id:"NavigationContent.chatHistoryOffDescriptionBusiness",defaultMessage:"When history is turned off, new chats on this browser won't appear in your history on any of your devices, or stored for longer than 30 days. <b>This setting does not sync across browsers or devices.</b> {learnMore}"},learnMore:{id:"NavigationContent.learnMore",defaultMessage:"Learn more"},enableChatHistory:{id:"NavigationContent.enableChatHistory",defaultMessage:"Enable chat history"},closeSidebar:{id:"NavigationContent.closeSidebar",defaultMessage:"Close sidebar"},signInToChat:{id:"NavigationContent.signInToChat",defaultMessage:"Sign in to ChatGPT"},signUpOrLogIn:{id:"NavigationContent.signUpOrLogIn",defaultMessage:"Sign up or log in"},unauthSignupCta:{id:"NavigationContent.unauthSignupCta",defaultMessage:"Sign up"},unauthLoginCta:{id:"NavigationContent.unauthLoginCta",defaultMessage:"Log in"}})},97641:function(e,t,r){r.d(t,{H1:function(){return m},Vk:function(){return d},tS:function(){return u},zG:function(){return f}});var n=r(72438),s=r(91530),a=r.n(s),i=r(52959);function o(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),r.push.apply(r,n)}return r}function l(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?o(Object(r),!0).forEach(function(t){(0,n.Z)(e,t,r[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):o(Object(r)).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))})}return e}let c={showEmbeddedPaymentModal:!1,embeddedCheckoutInstance:void 0,showFreeTrialLoadingPayment:!1,showConfirmDismissFreeTrial:!1,didCloseFreeTrial:!1},u=(0,i.Ue)()(e=>l(l({},c),{},{setShowEmbeddedPaymentModal:function(t){let r=arguments.length>1&&void 0!==arguments[1]?arguments[1]:a();e({showEmbeddedPaymentModal:t}),r&&r()},setEmbeddedCheckoutInstance:function(t){let r=arguments.length>1&&void 0!==arguments[1]?arguments[1]:a();e({showEmbeddedPaymentModal:t}),r&&r()}}));function d(e){u.setState({showFreeTrialLoadingPayment:e})}function f(e){u.setState({showConfirmDismissFreeTrial:e})}function m(e){u.setState({didCloseFreeTrial:e})}}}]);
//# sourceMappingURL=6469-360c0e0379cff1d0.js.map