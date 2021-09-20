<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header"></div>

          <div class="card-body">
            <form class="form-horizontal row">
              <div class="col-md-4">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" v-model="horizontal" /> Horizontal
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" v-model="collapsable" /> Collapsable
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkbox">
                  <label>
                    <input
                      type="checkbox"
                      v-model="expandAll"
                      @change="expandChange"
                    />
                    Expand All
                  </label>
                </div>
              </div>
              <p><br /></p>
              <p><br /></p>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label col-md-5">labelClassName:</label>
                  <div class="col-md-7">
                    <select class="form-control" v-model="labelClassName">
                      <option value="bg-white">bg-white</option>
                      <option value="bg-orange">bg-orange</option>
                      <option value="bg-gold">bg-gold</option>
                      <option value="bg-gray">bg-gray</option>
                      <option value="bg-lightpink">bg-lightpink</option>
                      <option value="bg-chocolate">bg-chocolate</option>
                      <option value="bg-tomato">bg-tomato</option>
                    </select>
                  </div>
                </div>
              </div>
            </form>
            <vue2-org-tree
              :data="data"
              :horizontal="horizontal"
              :collapsable="collapsable"
              :label-class-name="labelClassName"
              :render-content="renderContent"
              selected-class-name="bg-tomato"
              selected-key="selectedKey"
              @on-expand="onExpand"
              @on-node-click="onNodeClick"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    this.toggleExpand(this.data, this.expandAll);
  },
  data() {
    return {
      data: {
        id: 0,
        label: "بني الحارث الحجاز",
        children: [
          {
            id: 2,
            label: "ناصرة",
            children: [
              {
                id: 5,
                label: "الموسى",
              },
              {
                id: 6,
                label: "آل شعيث",
              },
              {
                id: 9,
                label: "الحسكان",
              },
            ],
          },
          {
            id: 3,
            label: "الشالوى",
            children: [
              {
                id: 7,
                label: "销售一部",
              },
              {
                id: 8,
                label: "销售二部",
              },
            ],
          },
          {
            id: 4,
            label: "بنيوس",
          },
        ],
      },
      expandAll: true,
      horizontal: false,
      collapsable: true,
    };
  },
  methods: {
    labelClassName: function (data) {
      return "clickable-node";
    },
    renderContent: function (h, data) {
      return data.label;
    },
    onExpand: function (e, data) {
      if ("expand" in data) {
        data.expand = !data.expand;

        if (!data.expand && data.children) {
          this.collapse(data.children);
        }
      } else {
        this.$set(data, "expand", true);
      }
    },
    onNodeClick: function (e, data) {
      console.log("onNodeClick: %o", data);
      this.$set(data, "selectedKey", !data.selectedKey);
    },
    collapse: function (list) {
      var _this = this;
      list.forEach(function (child) {
        if (child.expand) {
          child.expand = false;
        }

        child.children && _this.collapse(child.children);
      });
    },
    expandChange: function () {
      this.toggleExpand(this.data, this.expandAll);
    },
    toggleExpand: function (data, val) {
      var _this = this;
      if (Array.isArray(data)) {
        data.forEach(function (item) {
          _this.$set(item, "expand", val);
          if (item.children) {
            _this.toggleExpand(item.children, val);
          }
        });
      } else {
        this.$set(data, "expand", val);
        if (data.children) {
          _this.toggleExpand(data.children, val);
        }
      }
    },
  },
};
</script>

<style scoped>
.org-tree-node-label {
  white-space: nowrap;
}
.bg-white {
  background-color: white;
}
.bg-orange {
  background-color: orange;
}
.bg-gold {
  background-color: gold;
}
.bg-gray {
  background-color: gray;
}
.bg-lightpink {
  background-color: lightpink;
}
.bg-chocolate {
  background-color: chocolate;
}
.bg-tomato {
  background-color: tomato;
}
.clickable-node {
  cursor: pointer;
}
</style>