@extends('master')

@section('page-section', 'Produk')

@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/css/datatables.bootstrap5.css') }}">
<style>
.tree .hide {
    display: none;
}

.tree ul {
    padding-top: 20px !important;
    position: relative !important;
    transition: all 0.5s !important;
}

.tree li {
    float: left !important;
    text-align: center !important;
    list-style-type: none !important;
    position: relative !important;
    padding: 20px 5px 0 5px !important;
    transition: all 0.5s !important;
}

/*We will use ::before and ::after to draw the connectors*/
.tree li::before,
.tree li::after {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    right: 50% !important;
    border-top: 1px solid #ccc !important;
    width: 50% !important;
    height: 20px !important;
}

.tree li::after {
    right: auto !important;
    left: 50% !important;
    border-left: 1px solid #ccc !important;
}

/*We need to remove left-right connectors from elements without 
	any siblings*/
.tree li:only-child::after,
.tree li:only-child::before {
    display: none !important;
}

/*Remove space from the top of single children*/
.tree li:only-child {
    padding-top: 0 !important;
}

/*Remove left connector from first child and 
	right connector from last child*/
.tree li:first-child::before,
.tree li:last-child::after {
    border: 0 none !important;
}

/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before {
    border-right: 1px solid #ccc !important;
    border-radius: 0 5px 0 0 !important;
}

.tree li:first-child::after {
    border-radius: 5px 0 0 0 !important;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    left: 50% !important;
    border-left: 1px solid #ccc !important;
    width: 0 !important;
    height: 20px !important;
}

.tree li a {
    border: 1px solid #ccc !important;
    padding: 4px 8px !important;
    text-decoration: none !important;
    display: inline-block !important;
    border-radius: 10px !important;
    transition: all 0.5s !important;
}

.tree li a.selected {
    color: #ffffff !important;
    background-color: #5bc0de !important;
     !important;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover,
.tree li a:hover+ul li a {
    background: #c8e4f8 !important;
    color: #000 !important;
    border: 1px solid #94a0b4 !important;
}

.tree ul {
    padding-top: 20px !important;
    position: relative !important;

    transition: all 0.5s !important;
    -webkit-transition: all 0.5s !important;
    -moz-transition: all 0.5s !important;
}

.tree li {
    white-space: nowrap !important;
    float: left !important;
    text-align: center !important;
    list-style-type: none !important;
    position: relative !important;
    padding: 20px 5px 0 5px !important;

    transition: all 0.5s !important;
    -webkit-transition: all 0.5s !important;
    -moz-transition: all 0.5s !important;
}

/*We will use ::before and ::after to draw the connectors*/
.tree li::before,
.tree li::after {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    right: 50% !important;
    border-top: 1px solid #ccc !important;
    width: 50% !important;
    height: 20px !important;
}

.tree li::after {
    right: auto !important;
    left: 50% !important;
    border-left: 1px solid #ccc !important;
}

/*We need to remove left-right connectors from elements without
	 any siblings*/
.tree li:only-child::after,
.tree li:only-child::before {
    display: none !important;
}

/*Remove space from the top of single children*/
.tree li:only-child {
    padding-top: 0 !important;
}

/*Remove left connector from first child and
	 right connector from last child*/
.tree li:first-child::before,
.tree li:last-child::after {
    border: 0 none !important;
}

/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before {
    border-right: 1px solid #ccc !important;
    border-radius: 0 5px 0 0 !important;
    -webkit-border-radius: 0 5px 0 0 !important;
    -moz-border-radius: 0 5px 0 0 !important;
}

.tree li:first-child::after {
    border-radius: 5px 0 0 0 !important;
    -webkit-border-radius: 5px 0 0 0 !important;
    -moz-border-radius: 5px 0 0 0 !important;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    left: 50% !important;
    border-left: 1px solid #ccc !important;
    width: 0 !important;
    height: 20px !important;
}

.tree li a {
    border: 1px solid #ccc !important;
    padding: 5px 10px !important;
    text-decoration: none !important;
    color: #666 !important;
    font-family: arial, verdana, tahoma !important;
    font-size: 11px !important;
    display: inline-block !important;

    border-radius: 5px !important;
    -webkit-border-radius: 5px !important;
    -moz-border-radius: 5px !important;

    transition: all 0.5s !important;
    -webkit-transition: all 0.5s !important;
    -moz-transition: all 0.5s !important;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover,
.tree li a:hover+ul li a {
    background: #c8e4f8 !important;
    color: #000 !important;
    border: 1px solid #94a0b4 !important;
}

/*Connector styles on hover*/
.tree li a:hover+ul li::after,
.tree li a:hover+ul li::before,
.tree li a:hover+ul::before,
.tree li a:hover+ul ul::before {
    border-color: #94a0b4 !important;
}

.viewer {
    overflow-x: scroll !important;
    overflow-y: scroll !important;
    height: 361px !important;
}

#fp-tree {
    width: 9000px !important;
    height: 9000px !important;
}
</style>
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Analisa FP-Growth</h4>
    <div class="row g-3 align-items-start">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Analisa</h5>
                <div class="card-body">
                    <form id="analyze-form">
                        <div class="row g-2 mb-2">
                            <div class="col-12 col-md-3">
                                <label for="start" class="form-label">Tanggal Awal</label>
                                <input type="date" id="start" value="2023-02-14" name="start" class="form-control"
                                    required>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="end" class="form-label">Tanggal Awal</label>
                                <input type="date" id="end" value="2023-03-14" name="end" class="form-control" required>
                            </div>
                            <div class="col-6 col-md-2">
                                <label for="support" class="form-label">Min Support</label>
                                <input type="number" id="support" value="10" name="support" class="form-control"
                                    placeholder="10" required>
                            </div>
                            <div class="col-6 col-md-2">
                                <label for="confidence" class="form-label">Min Confidence</label>
                                <input type="number" id="confidence" value="60" name="confidence" class="form-control"
                                    placeholder="60" required>
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="confidence" class="form-label">&nbsp;</label>
                                <button id="btn-analyze" class="btn btn-primary w-100">Analisa</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12" id="analyze-placeholder">
            <div class="card w-100">
                <div class="card-body d-flex justify-content-center">
                    <div class="text-center">
                        <div class="d-flex w-100 justify-content-center">
                            <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_bdlrkrqv.json"
                                background="transparent" speed="1" style="width: 50%" loop autoplay>
                            </lottie-player>
                        </div>
                        <h6 class="mb-2">Pilih rentang waktu transaksi</h6>
                        <h6>dan isi nilai support dan confidence untuk dianalisa</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-none" id="analyze-content">
            <div class="card mb-3">
                <h5 class="card-header">Menghitung Nilai Support</h5>
                <div class="card-body text-nowrap">
                    <div class="table-responsive">
                        <table class="table datatable table-stripped" id="table-support">
                            <thead>
                                <tr>
                                    <th>ID Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Frequent</th>
                                    <th>Nilai Support</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <h5 class="card-header">Simulasi FP-Tree</h5>
                <div class="card-body text-nowrap tree">
                    <div class="viewer w-100">
                        <div id="fp-tree"></div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <h5 class="card-header">Hasil Analisa</h5>
                <div class="card-body text-nowrap">
                    <div class="table-responsive">
                        <table class="table datatable table-stripped" id="table-result">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item 1</th>
                                    <th>Item 2</th>
                                    <th>Confidence</th>
                                    <th>Lift Ratio</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <h5 class="card-header">Aturan yang Terbentuk</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable table-stripped" id="table-rule">
                            <thead>
                                <tr>
                                    <th style="max-width: 30px">No</th>
                                    <th>Aturan</th>
                                    <th style="max-width: 200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-js')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="{{ asset('assets/js/datatables-bootstrap5.js') }}"></script>
<script>
var baseURL = "{{ URL::to('/') }}";

$(document).ready(function() {
    var combinations = function(arr) {
        if (arr.length === 1) return [arr];
        else {
            subarr = combinations(arr.slice(1));
            return subarr.concat(subarr.map(e => e.concat(arr[0])), [
                [arr[0]]
            ]);
        }
    }

    String.prototype.replaceAll = function(search, replacement) {
        var target = this;
        return target.split(search).join(replacement);
    };

    var generateSupport = function(itemString, totalTransaction) {
        var pool = itemString.join(';').replaceAll(";|;", "|").replace("||", "|").split('|');

        FPTreeSim.supportPool = {};

        for (var i = pool.length - 1; i >= 0; i--) {
            var instances = combinations(pool[i].split(';'));

            for (var e = instances.length - 1; e >= 0; e--) {
                var key = instances[e].join(',');

                if (FPTreeSim.supportPool[key] != undefined) {
                    FPTreeSim.supportPool[key]++;
                } else {
                    FPTreeSim.supportPool[key] = 1;
                }
            }
        }

        var totalTransactions = totalTransaction;

        for (var support in FPTreeSim.supportPool) {
            FPTreeSim.supportPool[support] = {
                transaction_count: FPTreeSim.supportPool[support],
                total_transactions: totalTransactions,
                support_value: FPTreeSim.supportPool[support] / totalTransactions
            };
        }

        return FPTreeSim.supportPool;
    }

    var generateConfidence = function() {
        var resultFinal = [];
        for (var support in FPTreeSim.supportPool) {
            var confidence = {};
            if (
                FPTreeSim.supportPool[support].transaction_count >=
                FPTreeSim.minSupport
            ) {
                if (support.indexOf(',') >= 0) {
                    var rules = support.replace(/(,)([^,]+$)/, ';$2').split(';');
                    var antecedent = rules[0];
                    var consequent = rules[1];

                    var newAtecedent = '';
                    var newConsequent = '';

                    if (rules[0].split(',').every(item => item != '') && rules[1].split(',').every(item =>
                            item !=
                            '')) {
                        var atendencesSplit = rules[0].split(',')
                        var consequentSplit = rules[1].split(',')
                        atendencesSplit.forEach(function(item, k) {
                            if (k == atendencesSplit.length - 1) {
                                newAtecedent += FPTreeSim.all_product.filter((it) => it.id_produk ==
                                    item)[0].nama_produk
                            } else {
                                newAtecedent += FPTreeSim.all_product.filter((it) => it.id_produk ==
                                    item)[0].nama_produk + ', '
                            }
                        })
                        consequentSplit.forEach(function(item, k) {
                            if (k == consequentSplit.length - 1) {
                                newConsequent += FPTreeSim.all_product.filter((it) => it
                                    .id_produk ==
                                    item)[0].nama_produk
                            } else {
                                newConsequent += FPTreeSim.all_product.filter((it) => it
                                    .id_produk ==
                                    item)[0].nama_produk + ', '
                            }
                        })

                        var result = FPTreeSim.supportPool[support].support_value /
                            FPTreeSim.supportPool[antecedent].support_value;

                        var result_again = FPTreeSim.supportPool[support].support_value /
                            FPTreeSim.supportPool[consequent].support_value;

                        var min_confidence = $('#confidence').val() / 100

                        if (result >= min_confidence) {
                            confidence['atecedent'] = newAtecedent
                            confidence['consequent'] = newConsequent
                            confidence['confidence'] = result

                            if (consequent.includes(',')) {
                                const splits = consequent.split(',')
                                confidence['lift_ratio'] = result / FPTreeSim.sets.filter((item) => splits
                                    .every(split => item.includes(
                                        split))).length / FPTreeSim.totalTransaction * 100

                                confidence['benchmark'] = FPTreeSim.sets.filter((item) => splits
                                    .every(split => item.includes(
                                        split))).length / FPTreeSim.totalTransaction * 100
                            } else {
                                confidence['lift_ratio'] = result / FPTreeSim.all_support.filter((it) =>
                                    it
                                    .id_produk ==
                                    consequent)[0].support

                                confidence['benchmark'] = FPTreeSim.all_support.filter((it) => it
                                    .id_produk ==
                                    consequent)[0].support
                            }

                            resultFinal.push(JSON.stringify(confidence))
                        }

                        if (result_again >= min_confidence) {
                            confidence['atecedent'] = newConsequent
                            confidence['consequent'] = newAtecedent
                            confidence['confidence'] = result_again

                            if (antecedent.includes(',')) {
                                const splits = antecedent.split(',')
                                confidence['lift_ratio'] = result_again / FPTreeSim.sets.filter((item) =>
                                    splits
                                    .every(split => item.includes(
                                        split))).length / FPTreeSim.totalTransaction * 100

                                confidence['benchmark'] = FPTreeSim.sets.filter((item) => splits
                                    .every(split => item.includes(
                                        split))).length / FPTreeSim.totalTransaction * 100
                            } else {
                                confidence['lift_ratio'] = result_again / FPTreeSim.all_support.filter((
                                        it) =>
                                    it
                                    .id_produk ==
                                    antecedent)[0].support

                                confidence['benchmark'] = FPTreeSim.all_support.filter((it) => it
                                    .id_produk ==
                                    antecedent)[0].support
                            }

                            resultFinal.push(JSON.stringify(confidence))
                        }
                    }
                }
            }
        }

        let resultHtml = '';

        let uniqueResult = resultFinal.filter((element, index) => {
            return resultFinal.indexOf(element) === index;
        });

        uniqueResult.forEach(function(item, k) {
            const json = JSON.parse(item)
            if (json.confidence) {
                resultHtml += `
                <tr>
                    <td>${k + 1}</td>
                    <td style="text-overflow:ellipsis; overflow: hidden; max-width:20vw;" data-bs-toggle="tooltip" data-bs-offset="0,0" data-bs-placement="bottom" title="${json.atecedent}">${json.atecedent}</td>
                    <td style="text-overflow:ellipsis; overflow: hidden; max-width:20vw;" data-bs-toggle="tooltip" data-bs-offset="0,0" data-bs-placement="bottom" title="${json.consequent}">${json.consequent}</td>
                    <td style="text-overflow:ellipsis; overflow: hidden; max-width:1px;">${(json.confidence * 100).toFixed()}%</td>
                    <td style="text-overflow:ellipsis; overflow: hidden; max-width:1px;">${(json.lift_ratio * 100).toFixed(2)}</td>
                </tr>
            `
            }
        })

        let ruleHtml = '';
        let noRule = 1;
        uniqueResult.forEach(function(item, k) {
            const json = JSON.parse(item)
            if (json.confidence) {
                if ((json.lift_ratio * 100).toFixed(2) >= 1) {
                    ruleHtml += `
                        <tr>
                            <td>${noRule}</td>
                            <td>Jika pembeli membeli <strong>${json.atecedent}</strong> maka pembeli juga akan membeli <strong>${json.consequent}</strong> dengan nilai confidence ${(json.confidence * 100).toFixed()}% nilai ratio dari aturan ini adalah ${(json.lift_ratio * 100).toFixed(2)} atau valid</td>
                            <td><a target="_blank" class="btn btn-primary" href="${baseURL}/transaction/include?attecedent=${json.atecedent}&consequent=${json.consequent}">Lihat Transaksi</a></td>
                        </tr>
                    `
                    noRule++;
                }
            }
        })


        $('#table-result tbody').html(resultHtml)
        $('#table-rule tbody').html(ruleHtml)

        return confidence;
    }

    var sortObject = function(items) {
        var sortable = [];
        for (var i in items) {
            sortable.push([i, items[i]]);
        }
        sortable.sort(function(a, b) {
            return b[1] > a[1];
        });
        return sortable;
    };

    var FPTreeSim = {
        sets: [],
        all_product: [],
        all_support: [],
        items: {},
        minSupport: 0,
        orderedFreqItems: [],
        prevNode: 'tree-origin',
        currentNodeLevel: 0,
        currentRowLevel: 0,
        nodeAnimation: null,
        supportPool: {},
        totalTransaction: 0,
        confidencePool: {},

        cleanData: function(text, min_support, total_transaction, all_product, all_support) {
            FPTreeSim.sets = [];
            FPTreeSim.items = {};

            FPTreeSim.minSupport = 0;
            FPTreeSim.totalTransaction = 0;
            FPTreeSim.orderedFreqItems = [];

            FPTreeSim.prevNode = 'tree-origin';
            FPTreeSim.currentNodeLevel = 0;
            FPTreeSim.currentRowLevel = 0;
            clearInterval(FPTreeSim.nodeAnimation);
            FPTreeSim.nodeAnimation = null;
            FPTreeSim.minSupport = min_support / (100 / total_transaction);
            FPTreeSim.totalTransaction = total_transaction;
            FPTreeSim.all_product = all_product;
            FPTreeSim.all_support = all_support;
            FPTreeSim.identifySets(text);
        },
        identifySets: function(text) {
            var cansets = text.replace(/[{}]/ig, '').split('\n');
            for (var i = 0; i < cansets.length; i++) {
                cansets[i] = cansets[i].replace(/[\s]/ig, '').split(',');
            }
            FPTreeSim.sets = cansets;
            FPTreeSim.getItemCounts();
        },
        getItemCounts: function() {
            for (var i = 0; i < FPTreeSim.sets.length; i++) {
                for (var j = 0; j < FPTreeSim.sets[i].length; j++) {
                    var item = FPTreeSim.sets[i][j];
                    if (FPTreeSim.items.hasOwnProperty(item)) {
                        FPTreeSim.items[item] += 1;
                    } else if (item !== '') {
                        FPTreeSim.items[item] = 1;
                    }
                }
            }
            FPTreeSim.renderFrequentItems();
        },
        renderFrequentItems: function() {
            var itemlist = [];
            for (var i in FPTreeSim.items) {
                if (FPTreeSim.items[i] >= FPTreeSim.minSupport) {
                    itemlist.push({
                        name: i,
                        count: FPTreeSim.items[i]
                    });
                }
            }
            itemlist.sort(function(a, b) {
                return b.count - a.count;
            });
            FPTreeSim.renderItemTable();
        },
        renderItemTable: function() {
            var freqItems = '';
            let mainArray = [];


            for (var i = 0; i < FPTreeSim.sets.length; i++) {
                freqItems = '';
                var pad = sortObject(FPTreeSim.items);
                let subArray = [];
                for (var e = 0; e < pad.length; e++) {
                    var j = pad[e][0];
                    if (FPTreeSim.sets[i] == undefined) {
                        continue;
                    }

                    if (FPTreeSim.items[j] >= FPTreeSim.minSupport && FPTreeSim.sets[i].indexOf(j) > -
                        1) {
                        if (subArray.length == 0) {
                            subArray.push([j, FPTreeSim.items[j]]);
                        } else {
                            let idxx = 0;
                            let def = false;
                            for (const item of subArray) {
                                if (item[1] < FPTreeSim.items[j]) {
                                    subArray.splice(idxx, 0, [j, FPTreeSim.items[j]])
                                    def = true
                                    break;
                                }

                                idxx++;
                            }

                            if (!def) {
                                subArray.push([j, FPTreeSim.items[j]]);
                            }
                        }
                    }
                }

                mainArray.push(subArray)
            }


            let ixxs = 0;
            for (const item of mainArray) {
                freqItems = '';
                let ixx = 0;
                for (const el of item) {
                    FPTreeSim.orderedFreqItems.push(el[0]);
                    if (ixx == item.length - 1) {
                        FPTreeSim.orderedFreqItems.push('|');
                    } else {
                        ixx++;
                    }
                }
                ixxs++;
            }

            window.orderedFreqItems = FPTreeSim.orderedFreqItems.slice(0);
            generateSupport(window.orderedFreqItems, FPTreeSim.totalTransaction);
            FPTreeSim.confidencePool = generateConfidence();
            FPTreeSim.renderGraph();
        },
        renderGraph: function() {
            document.getElementById('fp-tree').innerHTML = '<ul><li id="tree-origin">' +
                '<a href="#" id="tree-origin-label">{}</a><ul id="tree-origin-children"></ul></li></ul>';
            FPTreeSim.nodeAnimation = setInterval(FPTreeSim.renderNode, 300);
        },
        renderNode: function() {
            $('a.selected').removeClass('selected');
            var item = FPTreeSim.orderedFreqItems.splice(0, 1);
            if (item.length === 0) {
                clearInterval(FPTreeSim.nodeAnimation);
                FPTreeSim.nodeAnimation = null;
            } else if (item.toString() === '|') {
                FPTreeSim.currentNodeLevel = 0;
                FPTreeSim.currentRowLevel++;
                FPTreeSim.prevNode = 'tree-origin';
            } else {
                var itemNode = document.getElementById('tree-node-' + item + '-' + FPTreeSim
                    .currentNodeLevel +
                    '-label');
                if (itemNode === null || itemNode.parentNode.parentNode.id !== FPTreeSim.prevNode +
                    '-children') {
                    document.getElementById(FPTreeSim.prevNode + '-children').innerHTML +=
                        '<li id="tree-node-' +
                        item + '-' + FPTreeSim.currentNodeLevel + '">' +
                        '<a href="#" id="tree-node-' + item + '-' + FPTreeSim.currentNodeLevel +
                        '-label">' +
                        item + ': 1</a><ul id="tree-node-' + item + '-' + FPTreeSim.currentNodeLevel +
                        '-children" class="hide"></ul></li>';
                    document.getElementById(FPTreeSim.prevNode + '-children').className = '';
                    itemNode = document.getElementById('tree-node-' + item + '-' + FPTreeSim
                        .currentNodeLevel +
                        '-label');
                } else {
                    setTimeout(function() {
                        var comps = itemNode.innerHTML.split(':');
                        itemNode.innerHTML = comps[0] + ': ' + (parseInt(comps[1]) + 1);
                    }, 10);
                }
                itemNode.className = 'selected';
                FPTreeSim.prevNode = 'tree-node-' + item + '-' + FPTreeSim.currentNodeLevel;
                FPTreeSim.currentNodeLevel++;
            }
        }
    };

    const analyze = async () => {
        $('.datatable').DataTable().destroy();
        const start_date = $("#start").val();
        const end_date = $("#end").val();
        const min_support = $("#support").val();
        const min_support_data = await fetch(`{{ URL::to('analyze/count_support') }}` +
            `?start_date=${start_date}&end_date=${end_date}&min_support=${min_support}`)
        const min_support_json = await min_support_data.json();
        let min_support_body = '';
        min_support_json.forEach(function(item) {
            min_support_body += `
                <tr>
                    <td>${item.id_produk}</td>
                    <td style="text-overflow:ellipsis; overflow: hidden; max-width:45vw;" data-bs-toggle="tooltip" data-bs-offset="0,0" data-bs-placement="bottom" title="${item.nama_produk}">${item.nama_produk}</td>
                    <td>${item.frequent}</td>
                    <td>${(item.support).toFixed()}%</td>
                </tr>
            `
        });

        $("#table-support tbody").html(min_support_body)

        const item_to_analyze = await fetch(`{{ URL::to('analyze/get_item_to_analyze') }}` +
            `?start_date=${start_date}&end_date=${end_date}`)

        const item_to_analyze_json = await item_to_analyze.json();

        const total_transaction = item_to_analyze_json.split('}').length - 1

        const all_product = await fetch(`{{ URL::to('products/all') }}`)

        const all_product_json = await all_product.json();

        FPTreeSim.cleanData(item_to_analyze_json, min_support, total_transaction, all_product_json,
            min_support_json);

        const tooltipTriggerList = [].slice.call(document.querySelectorAll(
            '[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        $('.datatable').DataTable();
    }

    $("#analyze-form").submit(function(e) {
        e.preventDefault();
        $("#analyze-placeholder").removeClass('d-none d-md-flex');
        $("#analyze-placeholder").addClass('d-none');
        $("#analyze-content").removeClass('d-none');
        $("#analyze-content").addClass('d-block');
        analyze();
    })
});
</script>
@endsection

@endsection