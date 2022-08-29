def get_pagination(start, max_value):

    base_link = '<li class="page-item{active}"><a class="page-link no-border" href="?page={url}">{name}</a></li>'  

    PageContiguous = 2
    num_per_page = 1

    if start == 1:
        pageindex = ""
    else:
        link_data = {"active": "","url": start-num_per_page, "name": "<span aria-hidden=\"true\">«</span>"}
        pageindex = base_link.format(**link_data)

    if (start > num_per_page):
        link_data = {"active": "","url": 1, "name": "1"}
        pageindex += base_link.format(**link_data)
        
    if (start > num_per_page * (PageContiguous + 2)):
        pageindex += '<span class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">...</span> '

    nCont = PageContiguous

    for k in range(nCont,0,-1):
        if (start - 1  > num_per_page * k):
            tmpStart = start - num_per_page * k
            link_data = {"active": "","url": tmpStart, "name": tmpStart}
            pageindex += base_link.format(**link_data)

    link_data = {"active": " active","url": start, "name": start}
    pageindex += base_link.format(**link_data)

    nCont = 1
    for k in range(nCont,PageContiguous+1,1):
        if (start + num_per_page * k <= max_value):
            tmpStart = start + num_per_page * k
            link_data = {"active": "","url": tmpStart, "name": tmpStart}
            pageindex += base_link.format(**link_data)
    
    if (start + num_per_page * (PageContiguous + 1) < max_value):
        pageindex += '<span class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">...</span>'
    
    if (start + num_per_page * PageContiguous < max_value):
        link_data = {"active": "","url": max_value, "name": max_value}
        pageindex += base_link.format(**link_data)

    if (start + num_per_page) > max_value:
        display_page = max_value
    else:
        display_page = (start + num_per_page)
    
    if not (start == max_value):
        if display_page > max_value - num_per_page:
            pageindex += ' '
        else:
            link_data = {"active": "","url": display_page, "name": "<span aria-hidden=\"true\">»</span>"}
            pageindex += base_link.format(**link_data)
    
    return Markup(pageindex)

def get_pagination2(start, max_value, has_next, has_prev, prev_num, next_num):

    base_link = '<li class="page-item{active}"><a class="page-link no-border" href="?page={url}">{name}</a></li>'  

    PageContiguous = 2
    num_per_page = 1
    pageindex = ""

    if has_prev:
        link_data = {"active": "","url": prev_num, "name": "<span aria-hidden=\"true\">«</span>"}
        pageindex = base_link.format(**link_data)

    if (start > num_per_page):
        link_data = {"active": "","url": 1, "name": "1"}
        pageindex += base_link.format(**link_data)
        
    if (start > num_per_page * (PageContiguous + 2)):
        pageindex += '<span class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">...</span> '

    nCont = PageContiguous

    for k in range(nCont,0,-1):
        if (start - 1  > num_per_page * k):
            tmpStart = start - num_per_page * k
            link_data = {"active": "","url": tmpStart, "name": tmpStart}
            pageindex += base_link.format(**link_data)

    link_data = {"active": " active","url": start, "name": start}
    pageindex += base_link.format(**link_data)

    nCont = 1
    for k in range(nCont,PageContiguous+1,1):
        if (start + num_per_page * k <= max_value):
            tmpStart = start + num_per_page * k
            link_data = {"active": "","url": tmpStart, "name": tmpStart}
            pageindex += base_link.format(**link_data)
    
    if (start + num_per_page * (PageContiguous + 1) < max_value):
        pageindex += '<span class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">...</span>'
    
    if (start + num_per_page * PageContiguous < max_value):
        link_data = {"active": "","url": max_value, "name": max_value}
        pageindex += base_link.format(**link_data)

    if has_next:
        link_data = {"active": "","url": next_num, "name": "<span aria-hidden=\"true\">»</span>"}
        pageindex += base_link.format(**link_data)
    
    return Markup(pageindex)
